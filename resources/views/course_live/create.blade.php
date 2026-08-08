@extends('layout.course_ins')
@section("title","Live Create")
@section("page","Instructor Live Class Create")

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

            <!-- HEADER BAR -->
            <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 p-6 text-white">
                <h2 class="text-xl font-bold">New Live Create</h2>
                <p class="text-white/70 text-sm">Using JitSi Video Call System</p>
            </div>
            <form action="{{ route('courses.live.store', $course) }}" method="POST" class="bg-white/50 space-y-4 p-6">
                @csrf

                <!-- <div>
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ old('title') }}" required>
                </div> -->

                <div>
                    <label class="text-sm font-semibold text-slate-700">Title</label>
                    <input type="text" name="title" required
                        class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                        placeholder="Enter Live title" value="{{ old('title') }}">
                    <p class="text-red-500 text-sm mt-1 hidden" id="error_title"></p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                        placeholder="Write description">{{ old('description') }}</textarea>
                </div>

                <!-- <div>
                    <label class="block mb-1 font-medium">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
                </div> -->

                <div>
                    <label class="block mb-1 font-medium">Scheduled At</label>
                    <input type="datetime-local" name="scheduled_at" class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none" value="{{ old('scheduled_at') }}">
                </div>

                <div class="flex items-center gap-2 hidden">
                    <input type="checkbox" name="recording_enabled" value="1" id="recording_enabled" {{ old('recording_enabled') ? 'checked' : '' }}>
                    <label for="recording_enabled">Enable recording</label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
                    <a href="{{ route('courses.live.index', $course) }}" class="px-4 py-2 bg-gray-200 rounded">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection