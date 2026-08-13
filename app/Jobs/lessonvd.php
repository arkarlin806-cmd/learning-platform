<?php

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
