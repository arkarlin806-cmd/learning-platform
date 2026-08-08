@extends('layout.course_ins')
@section("title","Lesson Sumaries")
@section("page","Instructor Save, Add And Repari Lesson Sumaries")

@section('content')


<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">
            AI Lesson Review
        </h1>
        <p class="text-slate-500">
            Edit AI-generated content before saving to database
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- MAIN EDITOR -->
        <div class="lg:col-span-2 space-y-6">

            <!-- TITLE CARD -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <label class="text-sm font-semibold text-slate-600">Title</label>

                <input id="title"
                    value="{{ $summary['title'] ?? '' }}"
                    class="w-full mt-2 px-4 py-3 bg-slate-100 border border-slate-300 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none">

            </div>

            <!-- SUMMARY -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <label class="text-sm font-semibold text-slate-600">Summary</label>

                <textarea id="summary" rows="8"
                    class="w-full mt-2 px-4 py-3 bg-slate-100 border border-slate-300 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none">{{ $summary['summary'] ?? '' }}</textarea>

            </div>

            <!-- KEY POINTS -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-slate-800">Key Points</h3>

                    <button onclick="addPoint()"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm">
                        + Add
                    </button>
                </div>

                <div id="points" class="space-y-3">

                    @foreach(($summary['key_points'] ?? []) as $point)
                    <div class="flex gap-2">
                        <input class="point w-full px-4 py-2 bg-slate-100 border border-slate-300 rounded-xl"
                            value="{{ $point }}">
                        <i onclick="this.parentElement.remove()" class="ri-close-circle-line text-red-600 mt-2 text-2xl"></i>
                    </div>
                    @endforeach

                </div>
            </div>

            <!-- SAVE BUTTON -->
            <button onclick="saveSummary()"
                class="w-full py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-2xl font-bold hover:opacity-90">

                Save Final Summary
            </button>

        </div>

        <!-- SIDE PANEL -->
        <div class="space-y-6">

            <div class="bg-white rounded-3xl p-6 border shadow">
                <h3 class="font-bold mb-2">Instructor Tools</h3>

                <ul class="text-sm text-slate-600 space-y-2">
                    <li>✔ Edit AI title</li>
                    <li>✔ Rewrite summary</li>
                    <li>✔ Add/remove key points</li>
                    <li>✔ Final approval save</li>
                </ul>
            </div>

            <div class="bg-slate-900 text-white rounded-3xl p-6">
                <h3 class="font-bold mb-2">Important</h3>
                <p class="text-sm text-slate-300">
                    This is cached AI data. Nothing is saved until you click SAVE.
                </p>
            </div>

        </div>

    </div>

</div>

<!-- SWEETALERT -->

<script>
    // ADD KEY POINT
    // ======================
    function addPoint() {

        const container = document.getElementById('points');

        const div = document.createElement('div');
        div.className = "flex gap-2";

        div.innerHTML = `
            <input class="point w-full px-4 py-2 bg-slate-100 border border-slate-300 rounded-xl" placeholder="New point">
            <i onclick="this.parentElement.remove()" class="ri-close-circle-line text-red-600 mt-2 text-2xl"></i>

        `;

        container.appendChild(div);
    }

    // ======================
    // SAVE FINAL SUMMARY
    // ======================
    async function saveSummary() {

        const title = document.getElementById('title').value;
        const summary = document.getElementById('summary').value;

        const points = Array.from(document.querySelectorAll('.point'))
            .map(i => i.value)
            .filter(v => v.trim() !== '');

        try {
            const res = await fetch("{{ route('lesson.save.summary', $lesson->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    title,
                    summary,
                    key_points: points
                })
            });

            const data = await res.json();

            if (!res.ok) throw data;

            Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: 'Lesson summary saved successfully'
            }).then(() => {
                window.location.href = `{{ route('lesson.show',$course->id) }}`;
            });

        } catch (err) {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: err.message || 'Save failed'
            });

        }
    }
</script>

@endsection