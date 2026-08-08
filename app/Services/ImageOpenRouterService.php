<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class ImageOpenRouterService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.key');
        $this->baseUrl = 'https://openrouter.ai/api/v1/chat/completions';
        $this->model = config('services.openrouter.model', 'openai/gpt-oss-120b:free');
    }

    public function optimizePrompt(
        string $prompt,
        ?string $negativePrompt = null,
        ?string $imageType = null
    ): string {

        $systemPrompt = <<<PROMPT
You are an expert AI prompt engineer.

Your task:

Convert the user's request into one highly detailed English prompt for an AI image generator.

Rules:

- Output ONLY the optimized prompt.
- Do not explain anything.
- Translate non-English text into natural English.
- Preserve all important details.
- Add professional photography or digital art details when appropriate.
- Add lighting, composition, camera angle, quality, realism.
- If image type is specified, follow that style.
- Never include negative prompts in the final prompt.
PROMPT;

        $userPrompt = "User Prompt:\n{$prompt}\n";

        if (!empty($imageType)) {
            $userPrompt .= "\nImage Type: {$imageType}";
        }

        if (!empty($negativePrompt)) {
            $userPrompt .= "\nNegative Prompt: {$negativePrompt}";
        }

        $response = Http::timeout(90)
            ->retry(3, 2000)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
                'Content-Type' => 'application/json',
            ])
            ->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => $userPrompt,
                    ],
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

        if (!$response->successful()) {
            throw new Exception(
                'OpenRouter Error: ' . $response->body()
            );
        }

        $content = data_get(
            $response->json(),
            'choices.0.message.content'
        );

        if (!$content) {
            throw new Exception('OpenRouter returned an empty response.');
        }

        return trim($content);
    }
}
