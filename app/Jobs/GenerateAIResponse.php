<?php

namespace App\Jobs;

use App\Models\Message;
use App\Services\AIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateAIResponse implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    protected $conversationId;

    public function __construct($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    public function handle(AIService $aiService)
    {
        try {

            $messages = Message::where(
                'conversation_id',
                $this->conversationId
            )
                ->orderBy('id')
                ->get();

            $history = [];

            foreach ($messages as $msg) {
                if (empty($msg->content)) {
                    continue;
                }

                $history[] = [
                    'role' => $msg->role,
                    'content' => (string)$msg->content
                ];
            }

            if (count($history) === 0) {
                return;
            }

            $reply = $aiService
                ->sendMessage($history);

            Message::create([
                'conversation_id' =>
                $this->conversationId,

                'role' => 'assistant',

                'content' => $reply
            ]);
        } catch (\Throwable $e) {

            Log::error(
                'AI Job Failed',
                [
                    'message' =>
                    $e->getMessage()
                ]
            );

            Message::create([
                'conversation_id' =>
                $this->conversationId,

                'role' => 'assistant',

                'content' =>
                '⚠️ Connection Failed. Please try again.'
            ]);
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error(
            'Queue Failed',
            [
                'message' =>
                $exception->getMessage()
            ]
        );

        Message::create([
            'conversation_id' =>
            $this->conversationId,

            'role' => 'assistant',

            'content' =>
            '⚠️ Request timeout. Please retry.'
        ]);
    }
}
