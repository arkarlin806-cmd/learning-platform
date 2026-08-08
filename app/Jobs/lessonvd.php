<?php

// namespace App\Jobs;

// use App\Models\Lesson;
// use App\Models\lesson_summary;
// use App\Services\OpenAIService;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;

// class lessonvd implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     public int $lessonId;

//     public function __construct(int $lessonId)
//     {
//         $this->lessonId = $lessonId;
//     }


//     public function handle(OpenAIService $aiService): void
//     {
//         try {
//             $lesson = Lesson::findOrFail($this->lessonId);
//             // 10%
//             $lesson->update([
//                 'summary_status' => 'processing',
//                 'summary_progress' => 10,
//                 'summary_error' => null,
//             ]);

//             // 25%
//             $lesson->update([
//                 'summary_progress' => 25,
//             ]);

//             // AI summary process
//             $result = $aiService->processLesson($lesson, function ($progress) use ($lesson) {
//                 $lesson->update([
//                     'summary_status' => 'processing',
//                     'summary_progress' => $progress,
//                 ]);
//             });

//             // 90%
//             $lesson->update([
//                 'summary_progress' => 90,
//             ]);


//             lesson_summary::create([
//                 'lesson_id' => $lesson->id,
//                 'title' => $result['title'] ?? '',
//                 'summary' => $result['summary'] ?? '',
//                 'key_points' => $result['key_points'] ?? []
//             ]);
//             // 100%
//             $lesson->update([
//                 'summary_status' => 'completed',
//                 'summary_progress' => 100,
//                 'summary_error' => null,
//             ]);
//         } catch (\Throwable $e) {
//             $message = $e->getMessage();
//             if (str_contains($message, '524') || str_contains($message, 'timeout') || str_contains($message, 'cURL error 28')) {
//                 $message = 'Audio transcription timed out. Please try again or use a smaller media file';
//             } else if (str_contains($message, '429')) {
//                 $message = 'Service error!.';
//             }
//             $lesson->update([
//                 'summary_status' => 'failed',
//                 'summary_progress' => 0,
//                 'summary_error' => $message,
//             ]);

//             throw $e;
//         }
//     }
// }



namespace App\Jobs;

use App\Models\Lesson;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class lessonvd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $lessonId;

    public function __construct(int $lessonId)
    {
        $this->lessonId = $lessonId;
    }

    public function handle(OpenAIService $aiService): void
    {
        $lesson = Lesson::findOrFail($this->lessonId);

        try {

            $lesson->update([
                'summary_status' => 'processing',
                'summary_progress' => 10,
            ]);

            $lesson->update([
                'summary_progress' => 25,
            ]);

            $result = $aiService->processLesson($lesson, function ($progress) use ($lesson) {
                $lesson->update([
                    'summary_progress' => $progress,
                ]);
            });

            $lesson->update([
                'summary_progress' => 90,
            ]);

            // ✅ IMPORTANT CHANGE: NO DB SAVE
            Cache::put(
                "lesson_ai_{$lesson->id}",
                $result,
                now()->addHours(2)
            );

            $lesson->update([
                'summary_status' => 'completed',
                'summary_progress' => 100,
            ]);
        } catch (\Throwable $e) {

            $lesson->update([
                'summary_status' => 'failed',
                'summary_progress' => 0,
                'summary_error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
