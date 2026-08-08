<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;


class AIRoadmapService
{


    public function generate($goal)
    {
        $prompt = <<<PROMPT
                    You are an expert learning path designer.
                    Create a learning roadmap.
                    User Goal:
                    Career:
                    {$goal->target_role}
                    Current Level:
                    {$goal->current_level}
                    Daily Study Hours:
                    {$goal->daily_hours}
                    Return ONLY JSON.
                    Format:
                    {
                    "career":"",
                    "description":"",
                    "phases":[
                    {
                    "title":"",
                    "description":"",
                    "estimated_days":30,
                    "tasks":[
                    {
                    "title":"",
                    "description":"",
                    "estimated_minutes":60,
                    "lesson_count":10,
                    "practice_count":5
                    }
                    ]
                    }
                    ]
                    }
                    PROMPT;
        $response =
            Http::timeout(240)
            ->connectTimeout(120)
            ->withHeaders([
                'Authorization' =>
                'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type' =>
                'application/json'

            ])
            ->post(
                'https://openrouter.ai/api/v1/chat/completions',
                [
                    'model' =>
                    'openai/gpt-oss-120b',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' =>
                            'You create professional learning roadmaps.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7
                ]

            );

        if (!$response->successful()) {
            throw new \Exception(
                "AI API Error : " . $response->body()
            );
        }

        $data =
            $response->json();
        $content =
            $data['choices'][0]['message']['content'];
        // Remove markdown JSON block
        $content =
            str_replace(
                [
                    '```json',
                    '```'
                ],
                '',
                $content
            );
        return json_decode(
            $content,
            true
        );
    }
}
