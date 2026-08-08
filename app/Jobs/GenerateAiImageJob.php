<?php

namespace App\Jobs;

use App\Models\AiImage;
use App\Services\AiImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateAiImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;
    public int $tries = 3;

    public function __construct(
        public int $aiImageId
    ) {}

    public function handle(AiImageService $aiImageService): void
    {
        $image = AiImage::find($this->aiImageId);

        if (!$image) {
            return;
        }

        if ($image->status === 'completed') {
            return;
        }

        $aiImageService->generate($image);
    }

    public function failed(\Throwable $e): void
    {
        $image = AiImage::find($this->aiImageId);

        if ($image) {
            $image->update([
                'status' => 'failed',
                'progress' => 0
            ]);
        }
    }
}
