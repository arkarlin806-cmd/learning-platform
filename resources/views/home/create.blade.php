@extends('layout.user')
@section('title','Roadmap Create')
@section('page','Learner Create Roadmap With AI')

@section('content')
<form id="goalForm" class="space-y-8">
    @csrf
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2"> 🎯 Learning Goal </h2>
        <p class="text-gray-500 mb-8"> Tell us your learning goal to generate your personalized roadmap. </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Goal Name </label>
                <input type="text" name="goal_name" id="goal_name" placeholder="Become Professional Laravel Developer"
                    class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3 focus:ring-2 focus:ring-indigo-500">
                <small class="text-red-500 error-goal_name"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Target Career </label>
                <select name="target_role" id="target_role" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3 focus:ring-2 focus:ring-indigo-500">
                    <option value="">Choose Career</option>
                    <option value="Laravel Developer">Laravel Developer</option>
                    <option value="Frontend Developer">Frontend Developer</option>
                    <option value="Backend Developer">Backend Developer</option>
                    <option value="Full Stack Developer">Full Stack Developer</option>
                    <option value="AI Engineer">AI Engineer</option>
                    <option value="Data Scientist">Data Scientist</option>
                    <option value="Machine Learning Engineer">Machine Learning Engineer</option>
                    <option value="Mobile Developer">Mobile Developer</option>
                    <option value="DevOps Engineer">DevOps Engineer</option>
                </select>
                <small class="text-red-500 error-target_role"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Current Level </label>
                <select name="current_level" id="current_level" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3">
                    <option value="">Select Level</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
                <small class="text-red-500 error-current_level"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Daily Study Hours </label>
                <select name="daily_hours" id="daily_hours" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3">
                    <option value="">Select</option>
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                    <option value="3">3 Hours</option>
                    <option value="4">4 Hours</option>
                    <option value="5">5+ Hours</option>
                </select>
                <small class="text-red-500 error-daily_hours"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Daily Lessons </label>
                <input type="number" min="1" max="20" name="daily_lessons" id="daily_lessons" value="2"
                    class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3">
                <small class="text-red-500 error-daily_lessons"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Study Days Per Week </label>
                <select name="study_days_per_week" id="study_days_per_week" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3">
                    <option value="3">3 Days</option>
                    <option value="4">4 Days</option>
                    <option value="5" selected>5 Days</option>
                    <option value="6">6 Days</option>
                    <option value="7">7 Days</option>
                </select>
                <small class="text-red-500 error-study_days_per_week"></small>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2"> Target Finish Date (Optional) </label>
                <input type="date" name="estimated_finish_date" id="estimated_finish_date"
                    class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3">
                <small class="text-red-500 error-estimated_finish_date"></small>
            </div>
        </div>


    </div>
    <div class="flex justify-end">
        <button type="submit" id="generateBtn"
            class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
            <svg id="loadingIcon" class="hidden w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"> </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"> </path>
            </svg>
            <span id="btnText"> Generate Learning Roadmap </span>
        </button>
    </div>
</form>

<script>
    const form = document.getElementById('goalForm');
    const button = document.getElementById('generateBtn');
    const loadingIcon = document.getElementById('loadingIcon');
    const btnText = document.getElementById('btnText');
    form.addEventListener('submit', async function(e) {
        e.preventDefault(); // Clear validation errors 
        document.querySelectorAll("[class^='error-']").forEach(el => {
            el.innerHTML = "";
        });
        // Loading 
        button.disabled = true;
        loadingIcon.classList.remove("hidden");
        btnText.innerHTML = "Generating Roadmap...";
        const formData = {
            goal_name: document.getElementById("goal_name").value,
            target_role: document.getElementById("target_role").value,
            current_level: document.getElementById("current_level").value,
            daily_hours: document.getElementById("daily_hours").value,
            daily_lessons: document.getElementById("daily_lessons").value,
            study_days_per_week: document.getElementById("study_days_per_week").value,
            estimated_finish_date: document.getElementById("estimated_finish_date").value
        };
        try {
            const response = await fetch("{{ route('learning.goal.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });
            const result = await response.json();
            if (response.status === 422) {
                Object.keys(result.errors).forEach(function(key) {
                    let errorBox = document.querySelector(".error-" + key);
                    if (errorBox) {
                        errorBox.innerHTML = result.errors[key][0];
                    }
                });
            } else if (result.status) {
                button.classList.remove("bg-indigo-600");
                button.classList.add("bg-green-600");
                btnText.innerHTML = "Roadmap Generated ✓";
                setTimeout(function() {
                    window.location.href = result.redirect;
                }, 800);
            } else {
                alert(result.message ?? "Something went wrong.");
            }
        } catch (error) {
            console.error(error);
            alert("Server Error.");
        }
        button.disabled = false;
        loadingIcon.classList.add("hidden");
        btnText.innerHTML = "Generate Learning Roadmap";
    });
</script>
@endsection