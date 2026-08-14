<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Log;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;

class OpenAIService
{
    // public function processLesson(Lesson $lesson, ?callable $progressCallback = null): array
    // {
    //     // $filePath = storage_path('app/public/' . $lesson->file_path);

    //     // if (!file_exists($filePath)) {
    //     //     throw new \Exception('Lesson file not found.');
    //     // }
    //     $disk = Storage::disk('b2');

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Check B2 file
    //     |--------------------------------------------------------------------------
    //     */

    //     if (!$disk->exists($lesson->file_path)) {
    //         throw new \Exception(
    //             'Lesson file not found in Backblaze B2.'
    //         );
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Temporary directory
    //     |--------------------------------------------------------------------------
    //     */

    //     $tempDir = storage_path('app/temp');

    //     if (!is_dir($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     $extension = strtolower(
    //         pathinfo($lesson->file_path, PATHINFO_EXTENSION)
    //     );

    //     $localFile = $tempDir . '/' .
    //         uniqid('lesson_', true) .
    //         '.' .
    //         $extension;

    //     /*
    //     |--------------------------------------------------------------------------
    //     | B2 → Local temporary file
    //     |--------------------------------------------------------------------------
    //     */

    //     $stream = $disk->readStream($lesson->file_path);

    //     if ($stream === false) {
    //         throw new \Exception(
    //             'Unable to read lesson file from B2.'
    //         );
    //     }

    //     $target = fopen($localFile, 'w');

    //     if ($target === false) {
    //         fclose($stream);

    //         throw new \Exception(
    //             'Unable to create temporary lesson file.'
    //         );
    //     }

    //     stream_copy_to_stream($stream, $target);

    //     fclose($target);
    //     fclose($stream);

    //     if (!file_exists($localFile)) {
    //         throw new \Exception(
    //             'Lesson temporary file was not created.'
    //         );
    //     }

    //     Log::info('LESSON FILE DOWNLOADED FROM B2', [
    //         'lesson_id' => $lesson->id,
    //         'b2_path'   => $lesson->file_path,
    //         'local_file' => $localFile,
    //         'size_mb'   => round(
    //             filesize($localFile) / 1024 / 1024,
    //             2
    //         ),
    //     ]);


    //     if ($progressCallback) $progressCallback(40);

    //     $text = $this->extractText($localFile);

    //     if ($progressCallback) $progressCallback(70);

    //     $result = $this->generateSummary($text);

    //     if ($progressCallback) $progressCallback(85);

    //     return $result;
    // }
    public function processLesson(
        Lesson $lesson,
        ?callable $progressCallback = null
    ): array {

        $disk = Storage::disk('b2');

        /*
        |--------------------------------------------------------------------------
        | Check B2 file
        |--------------------------------------------------------------------------
        */

        if (!$disk->exists($lesson->file_path)) {
            throw new \Exception(
                'Lesson file not found in Backblaze B2.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Temporary directory
        |--------------------------------------------------------------------------
        */

        $tempDir = storage_path('app/temp');

        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $extension = strtolower(
            pathinfo($lesson->file_path, PATHINFO_EXTENSION)
        );

        $localFile = $tempDir . '/' .
            uniqid('lesson_', true) .
            '.' .
            $extension;

        /*
        |--------------------------------------------------------------------------
        | B2 → Local temporary file
        |--------------------------------------------------------------------------
        */

        $stream = $disk->readStream($lesson->file_path);

        if ($stream === false) {
            throw new \Exception(
                'Unable to read lesson file from B2.'
            );
        }

        $target = fopen($localFile, 'w');

        if ($target === false) {
            fclose($stream);

            throw new \Exception(
                'Unable to create temporary lesson file.'
            );
        }

        stream_copy_to_stream($stream, $target);

        fclose($target);
        fclose($stream);

        if (!file_exists($localFile)) {
            throw new \Exception(
                'Lesson temporary file was not created.'
            );
        }

        Log::info('LESSON FILE DOWNLOADED FROM B2', [
            'lesson_id' => $lesson->id,
            'b2_path'   => $lesson->file_path,
            'local_file' => $localFile,
            'size_mb'   => round(
                filesize($localFile) / 1024 / 1024,
                2
            ),
        ]);

        try {

            if ($progressCallback) {
                $progressCallback(40);
            }

            /*
            |--------------------------------------------------------------------------
            | Extract
            |--------------------------------------------------------------------------
            */

            $text = $this->extractText($localFile);

            if ($progressCallback) {
                $progressCallback(70);
            }

            /*
            |--------------------------------------------------------------------------
            | Generate AI Summary
            |--------------------------------------------------------------------------
            */

            $result = $this->generateSummary($text);

            if ($progressCallback) {
                $progressCallback(85);
            }

            return $result;
        } finally {

            /*
            |--------------------------------------------------------------------------
            | Cleanup
            |--------------------------------------------------------------------------
            */

            if (file_exists($localFile)) {
                @unlink($localFile);
            }
        }
    }

    private function extractText(string $file): string
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            $parser = new Parser();
            $pdf = $parser->parseFile($file);
            return $pdf->getText();
        }

        $audio = $this->videoToAudio($file);
        return $this->whisper($audio);
    }

    private function videoToAudio(string $video): string
    {
        $tempDir = storage_path('app/temp');

        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $audio = $tempDir . '/' . uniqid() . '.mp3';

        $command = sprintf(
            'ffmpeg -i "%s" -vn -ac 1 -ar 16000 -b:a 64k "%s" -y',
            $video,
            $audio
        );

        exec($command);

        if (!file_exists($audio)) {
            throw new \Exception('Failed converting video to audio');
        }

        return $audio;
    }

    private function whisper(string $audio): string
    {
        $sizeMb = filesize($audio) / 1024 / 1024;

        if ($sizeMb <= 20) {
            return $this->transcribeChunk($audio);
        }

        return $this->transcribeLargeFile($audio);
    }

    private function transcribeChunk(string $file): string
    {
        $response = Http::timeout(300)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            ])
            ->attach('file', fopen($file, 'r'), basename($file))
            ->post(
                'https://api.groq.com/openai/v1/audio/transcriptions',
                [
                    'model' => 'whisper-large-v3-turbo'
                ]
            );

        if (!$response->successful()) {
            throw new \Exception('Whisper failed: ' . $response->body());
        }

        return $response->json()['text'] ?? '';
    }

    private function transcribeLargeFile(string $audio): string
    {
        $chunkDir = storage_path('app/chunks');

        if (!is_dir($chunkDir)) {
            mkdir($chunkDir, 0777, true);
        }

        foreach (glob($chunkDir . '/*') as $old) {
            @unlink($old);
        }

        $pattern = $chunkDir . '/chunk_%03d.mp3';

        exec(sprintf(
            'ffmpeg -i "%s" -f segment -segment_time 300 -acodec libmp3lame "%s" -y',
            $audio,
            $pattern
        ));

        $text = '';

        foreach (glob($chunkDir . '/*.mp3') as $chunk) {
            try {
                $text .= $this->transcribeChunk($chunk) . "\n\n";
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            @unlink($chunk);
        }

        return trim($text);
    }

    private function generateSummary(string $text): array
    {
        if (empty($text)) {
            return [
                'title' => 'No Content',
                'summary' => '',
                'key_points' => []
            ];
        }

        $text = mb_substr($text, 0, 50000);

        $response = Http::retry(3, 2000)
            ->timeout(180)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type' => 'application/json'
            ])
            ->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'openai/gpt-oss-120b',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Return JSON only: {"title":"","summary":"","key_points":[]}'
                    ],
                    [
                        'role' => 'user',
                        'content' => $text
                    ]
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('OpenRouter failed: ' . $response->body());
        }

        $content = $response['choices'][0]['message']['content'] ?? '';

        $json = json_decode($content, true);

        return $json ?: [
            'title' => 'AI Summary',
            'summary' => $content,
            'key_points' => []
        ];
    }
}
