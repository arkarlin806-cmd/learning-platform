<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class PollinationsImageService
{
    protected string $baseUrl = 'https://image.pollinations.ai/prompt';

    public function generate(
        string $prompt,
        int $width = 1024,
        int $height = 1024,
        string $model = 'flux',
        ?int $seed = null
    ): string {

        $seed ??= random_int(1, 999999999);

        $query = http_build_query([
            'width' => $width,
            'height' => $height,
            'model' => $model,
            'seed' => $seed,
            'nologo' => 'true',
            'enhance' => 'true',
            'safe' => 'true'
        ]);

        $url = $this->baseUrl . '/'
            . rawurlencode($prompt)
            . '?' . $query;

        $response = Http::retry(3, 2000)
            ->timeout(240)
            ->accept('image/png,image/jpeg,image/webp,*/*')
            ->withHeaders([
                'User-Agent' => config('app.name')
            ])
            ->get($url);

        if (!$response->successful()) {
            throw new Exception(
                'Pollinations Error: ' . $response->body()
            );
        }

        $contentType = strtolower(
            $response->header('Content-Type', '')
        );

        if (
            !str_contains($contentType, 'image/')
        ) {
            throw new Exception(
                'Pollinations did not return an image.'
            );
        }

        return $response->body();
    }
}
