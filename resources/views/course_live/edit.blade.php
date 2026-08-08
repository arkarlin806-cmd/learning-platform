@extends('layout.course_ins')
@section("title","Live Room")

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Edit Live Session</h1>

    <form action="{{ route('courses.live.update', [$course, $session]) }}" method="POST" class="bg-white/50 rounded-4xl shadow p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-lg font-bold">Title</label>
            <input type="text" name="title" class="w-full border border-slate-300 bg-blue-100/50 font-semibold text-sm rounded-lg p-3" value="{{ old('title', $session->title) }}" required>
        </div>

        <div>
            <label class="block mb-1 text-lg font-bold">Description</label>
            <textarea name="description" class="w-full border border-slate-300 bg-blue-100/50 font-semibold text-sm rounded-lg p-3" rows="4">{{ old('description', $session->description) }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-mediumtext-lg font-bold">Lesson ID</label>
            <input type="hidden" name="lesson_id" class="w-full border border-slate-300 bg-blue-100/50 font-semibold text-sm rounded-lg p-3" value="{{ old('lesson_id', $session->lesson_id) }}">
        </div>

        <div>
            <label class="block mb-1 text-lg font-bold">Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="w-full border border-slate-300 bg-blue-100/50 font-semibold text-sm rounded-lg p-3"
                value="{{ old('scheduled_at', optional($session->scheduled_at)->format('Y-m-d\TH:i')) }}">
        </div>

        <div>
            <label class="block mb-1 text-lg font-bold">Status</label>
            <select name="status" class="w-full border border-slate-300 bg-blue-100/50 font-semibold text-sm rounded-lg p-3">
                <option value="scheduled" {{ $session->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="live" {{ $session->status === 'live' ? 'selected' : '' }}>Live</option>
                <option value="ended" {{ $session->status === 'ended' ? 'selected' : '' }}>Ended</option>
                <option value="cancelled" {{ $session->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="recording_enabled" value="1" id="recording_enabled"
                {{ old('recording_enabled', $session->recording_enabled) ? 'checked' : '' }}>
            <label for="recording_enabled">Enable recording</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-10 py-2 bg-blue-700 text-white rounded-lg">Update</button>
            <a href="{{ route('courses.live.show', [$course, $session]) }}" class="px-12 py-2 bg-slate-200 border border-slate-300 rounded-lg">Back</a>
        </div>
    </form>
</div>
@endsection