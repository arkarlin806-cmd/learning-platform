<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    public function sendMessage(array $messages)
    {
        $response = Http::timeout(240)
            ->connectTimeout(10)
            ->withHeaders([
                'Authorization' =>
                'Bearer ' . env('OPENROUTER_API_KEY'),

                'Content-Type' =>
                'application/json',

                'HTTP-Referer' =>
                config('app.url'),

                'X-Title' =>
                config('app.name'),
            ])
            ->post(
                'https://openrouter.ai/api/v1/chat/completions',
                [
                    'model' =>
                    'openai/gpt-oss-120b',

                    'messages' =>
                    $messages,

                    'temperature' => 0.7
                ]
            );

        if (!$response->successful()) {
            Log::error(
                'OpenRouter Error',
                [
                    'status' =>
                    $response->status(),

                    'body' =>
                    $response->body()
                ]
            );

            throw new \Exception(
                'OpenRouter Error'
            );
        }

        return $response->json()['choices'][0]['message']['content']
            ?? 'No response';
    }
}
