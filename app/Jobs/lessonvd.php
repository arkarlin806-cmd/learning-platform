<?php

// namespace App\Jobs;

// use App\Models\Lesson;
// use App\Services\OpenAIService;
// use Illuminate\Bus\Queueable;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Log;

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
//         $lesson = Lesson::findOrFail($this->lessonId);

//         try {

//             $lesson->update([
//                 'summary_status' => 'processing',
//                 'summary_progress' => 10,
//             ]);

//             $lesson->update([
//                 'summary_progress' => 25,
//             ]);

//             $result = $aiService->processLesson($lesson, function ($progress) use ($lesson) {
//                 $lesson->update([
//                     'summary_progress' => $progress,
//                 ]);
//             });

//             $lesson->update([
//                 'summary_progress' => 90,
//             ]);

//             // ✅ IMPORTANT CHANGE: NO DB SAVE
//             Cache::put(
//                 "lesson_ai_{$lesson->id}",
//                 $result,
//                 now()->addHours(2)
//             );

//             $lesson->update([
//                 'summary_status' => 'completed',
//                 'summary_progress' => 100,
//             ]);
//         } catch (\Throwable $e) {

//             Log::error('LESSON AI PROCESSING FAILED', [
//                 'lesson_id' => $this->lessonId,
//                 'error' => $e->getMessage(),
//                 'file' => $e->getFile(),
//                 'line' => $e->getLine(),
//             ]);

//             $lesson->update([
//                 'summary_status' => 'failed',
//                 'summary_progress' => 0,
//                 'summary_error' => mb_substr(
//                     $e->getMessage(),
//                     0,
//                     300
//                 ),
//             ]);

//             throw $e;
//         }
//     }
// }

namespace App\Jobs;

use App\Models\Lesson;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
                'summary_status'   => 'processing',
                'summary_progress' => 10,
                'summary_error'    => null,
            ]);

            $lesson->update([
                'summary_progress' => 25,
            ]);

            $result = $aiService->processLesson(
                $lesson,
                function ($progress) use ($lesson) {

                    $lesson->update([
                        'summary_progress' => $progress,
                    ]);
                }
            );

            $lesson->update([
                'summary_progress' => 90,
            ]);

            /*
            |--------------------------------------------------------------------------
            | SAVE AI RESULT TO DATABASE
            |--------------------------------------------------------------------------
            */

            $lesson->update([
                'ai_generated' => json_encode(
                    $result,
                    JSON_UNESCAPED_UNICODE
                ),

                'summary_status'   => 'completed',
                'summary_progress' => 100,
                'summary_error'    => null,
            ]);

            Log::info('LESSON AI PROCESSING COMPLETED', [
                'lesson_id' => $lesson->id,
                'result_type' => gettype($result),
            ]);
        } catch (\Throwable $e) {

            Log::error('LESSON AI PROCESSING FAILED', [
                'lesson_id' => $this->lessonId,
                'error'      => $e->getMessage(),
                'file'       => $e->getFile(),
                'line'       => $e->getLine(),
            ]);

            $lesson->update([
                'summary_status'   => 'failed',
                'summary_progress' => 0,
                'summary_error'    => mb_substr(
                    $e->getMessage(),
                    0,
                    300
                ),
            ]);

            throw $e;
        }
    }
}
