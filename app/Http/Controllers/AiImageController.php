<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateAiImageJob;
use App\Models\AiImage;
use Illuminate\Http\Request;

class AiImageController extends Controller
{
    public function img()
    {
        return view('ai.image');
    }
    public function index(Request $request)
    {
        $images = AiImage::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return response()->json($images);
    }

    public function store(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:2000',
            'negative_prompt' => 'nullable|string|max:2000',
            'image_type' => 'nullable|string|max:100',
        ]);

        $image = AiImage::create([
            'user_id' => auth()->id(),
            'prompt' => $request->prompt,
            'negative_prompt' => $request->negative_prompt,
            'image_type' => $request->image_type,
            'status' => 'pending',
            'progress' => 0,
            'provider' => 'openrouter + pollinations',
        ]);

        GenerateAiImageJob::dispatch($image->id);

        return response()->json([
            'message' => 'Image generation started',
            'id' => $image->id,
            'status' => $image->status
        ]);
    }

    public function show($id)
    {
        $image = AiImage::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json($image);
    }

    public function status($id)
    {
        $image = AiImage::select('id', 'status', 'progress', 'image_url')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'id' => $image->id,
            'status' => $image->status,
            'progress' => $image->progress,
            'image_url' => $image->image_url
        ]);
    }

    public function destroy($id)
    {
        $image = AiImage::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $image->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
