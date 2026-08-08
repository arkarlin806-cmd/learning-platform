<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\User;
use App\Models\GroupChat;
use App\Models\GroupMessage;
use App\Models\GroupMessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupChatController extends Controller
{
    public function index(Course $course)
    {
        $courses = Course::all();
        $groupChat = GroupChat::where('course_id', $course->id)->first();

        $messages = $groupChat
            ? GroupMessage::with(['user', 'reply.user', 'attachments'])
            ->where('group_chat_id', $groupChat->id)
            ->orderBy('created_at', 'asc')
            ->get()
            : collect();
        $isPurchased = GroupChatController::isPurchased($course->id);
        $isInstructor = GroupChatController::isInstructor();
        if ($isInstructor || $isPurchased) {

            return view('group-chat.index', compact(
                'courses',
                'course',
                'groupChat',
                'messages',
                'isInstructor',
                'isPurchased'
            ));
        } else {
            abort(404, 'Please purchase courses!.');
        }
    }

    public function sendMessage(Request $request, Course $course)
    {
        $request->validate([
            'message' => 'nullable|string',
            'reply_id' => 'nullable|integer',
            'attachment' => 'nullable|file|max:10240'
        ]);

        $groupChat = GroupChat::where('course_id', $course->id)->firstOrFail();
        $currentUserId = $request->query('user_id', auth()->id());
        $message = GroupMessage::create([
            'group_chat_id' => $groupChat->id,
            'user_id' => $currentUserId,
            'reply_id' => $request->reply_id,
            'message' => $request->message,
        ]);

        $attachmentData = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/storage/chat-attachments', $fileName);
            $f = $file->store('chat-attachments', 'public');

            $attachment = GroupMessageAttachment::create([
                'group_message_id' => $message->id,
                'file' => $f,
                // 'file' => $fileName,
                'type' => $file->getClientOriginalExtension(),
            ]);

            $attachmentData = [
                'file' => $attachment->file,
                'type' => strtolower($attachment->type)
            ];
        }

        $responseData = [
            'id' => $message->id,
            'user_id' => $message->user_id,
            'user_name' => $message->user->name ?? 'User',
            'message' => $message->message,
            'created_at' => now()->timezone('Asia/Yangon')->format('h:i A'),
            'attachment' => $attachmentData,
            'reply' => $message->reply ? [
                'user_name' => $message->reply->user->name ?? 'User',
                'message' => $message->reply->message
            ] : null
        ];

        return response()->json(['success' => true, 'data' => $responseData]);
    }

    public function updateMessage(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        $message = GroupMessage::findOrFail($id);

        $message->update([
            'message' => $request->message,
            'is_edited' => true
        ]);

        return response()->json(['success' => true, 'text' => $message->message]);
    }

    public function deleteMessage($id)
    {
        $message = GroupMessage::findOrFail($id);

        foreach ($message->attachments as $attachment) {
            Storage::delete('public/chat-attachments/' . $attachment->file);
            $attachment->delete();
        }

        $message->delete();
        return response()->json(['success' => true]);
    }

    public function isInstructor()
    {
        $isInstructor = false;
        if (auth()->check()) {
            $isInstructor = User::where('id', auth()->id())
                ->where('role', '2')
                ->exists();
        }
        if ($isInstructor) {
            return true;
        } else {
            return false;
        }
    }

    public function isPurchased($courseId)
    {
        $isPurchased = false;
        if (auth()->check()) {
            $isPurchased = CourseOrder::where([
                'user_id' => auth()->id(),
                'course_id' => $courseId,
                'status' => 'paid'
            ])->exists();
        }
        if ($isPurchased) {
            return true;
        } else {
            return false;
        }
    }
}
