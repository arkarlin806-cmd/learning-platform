<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Jobs\GenerateAIResponse;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $conversation = Conversation::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return view('ai.chat', compact('conversation'));
    }
    public function send(Request $request)
    {
        try {

            $request->validate([
                'message' => 'required|string|max:10000',
                'conversation_id' => 'required'
            ]);

            Message::create([
                'conversation_id' => $request->conversation_id,
                'role' => 'user',
                'content' => $request->message
            ]);

            GenerateAIResponse::dispatch(
                $request->conversation_id
            );

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed'
            ], 500);
        }
    }

    public function regenerate(Request $request)
    {
        try {

            GenerateAIResponse::dispatch(
                $request->conversation_id
            );

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function messages()
    {
        $conversation = Conversation::where('user_id', auth()->id())->first();
        return Message::where('conversation_id', $conversation->id)
            ->orderBy('id')
            ->get();
    }
}
