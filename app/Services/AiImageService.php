<?php

namespace App\Services;

use App\Models\AiImage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AiImageService
{
    protected ImageOpenRouterService $openRouter;
    protected PollinationsImageService $pollinations;

    public function __construct(
        ImageOpenRouterService $openRouter,
        PollinationsImageService $pollinations
    ) {
        $this->openRouter = $openRouter;
        $this->pollinations = $pollinations;
    }

    public function generate(AiImage $image): AiImage
    {
        $image->update([
            'status' => 'processing',
            'progress' => 10,
            'provider' => 'openrouter + pollinations'
        ]);

        try {

            $optimizedPrompt = $this->openRouter->optimizePrompt(
                $image->prompt,
                $image->negative_prompt,
                $image->image_type
            );

            $image->update([
                'progress' => 40
            ]);

            $binaryImage = $this->pollinations->generate(
                $optimizedPrompt
            );

            $image->update([
                'progress' => 80
            ]);

            $filename = 'ai-images/' .
                now()->format('Y/m/d/') .
                Str::uuid() .
                '.png';

            Storage::disk('public')->put(
                $filename,
                $binaryImage
            );

            $image->update([
                'image_url' => Storage::url($filename),
                'status' => 'completed',
                'progress' => 100
            ]);
        } catch (\Throwable $e) {

            $image->update([
                'status' => 'failed'
            ]);

            throw $e;
        }

        return $image->fresh();
    }
}
