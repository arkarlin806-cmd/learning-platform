@extends('layout.course_ins')
@section("title","Learner")
@section("page","Single Course Learners Show and Monitor.")

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">
    <div>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-200/50 border border-sky-300 text-sky-800 text-sm font-semibold"> <i class="ri-bank-card-line"></i> Learner Management </span>
        <h1 class="mt-4 text-xl lg:text-3xl font-black text-gray-800">{{$course->title}} Learnes </h1>
        <p class="text-gray-500 mt-2"> Show, Analysis and Monitor Leanrers. </p>
    </div>
    <form method="GET" class="flex justify-end">
        <div class="flex md:flex-row gap-4 w-140">
            <div class="flex-1 relative">
                <svg
                    class="absolute left-5 top-1/2
                            -translate-y-1/2
                            w-5 h-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                </svg>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search learner name..."

                    class="w-full
                            rounded-2xl
                            border-2 
                            bg-blue-100/50 border border-slate-300
                            py-4
                            pl-14
                            pr-5
                            outline-none
                            focus:border-sky-500
                            focus:bg-white
                            duration-300">

            </div>

            <button
                class="px-8 py-4
                        rounded-2xl
                        text-white
                        font-bold
                        bg-blue-700
                        hover:scale-105
                        duration-300">

                Search

            </button>

        </div>

    </form>
</div>





<div class="mt-8">

    <div class="bg-white/80 backdrop-blur-xl rounded-[32px] border border-white shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="px-8 py-6 border-b border-slate-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-800">
                        Course Learners
                    </h2>
                    <p class="text-slate-500 mt-1">
                        Manage all enrolled learners.
                    </p>
                </div>
                <span
                    class="inline-flex items-center gap-2
                    px-5 py-3 rounded-2xl
                    bg-blue-700
                    text-white font-semibold">

                    👨‍🎓 {{ $learners->total() }} Students

                </span>
            </div>
        </div>

        <!-- desktop -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-8 py-5 text-left font-bold text-slate-600">
                            #
                        </th>
                        <th class="px-8 py-5 text-left font-bold text-slate-600">
                            Learner
                        </th>
                        <th class="px-8 py-5 text-left font-bold text-slate-600">
                            Email
                        </th>
                        <th class="px-8 py-5 text-left font-bold text-slate-600">
                            Purchase
                        </th>
                        <th class="px-8 py-5 text-center font-bold text-slate-600">
                            Status
                        </th>
                        @if(auth()->user()->role == 2)
                        <th class="px-8 py-5 text-center font-bold text-slate-600">
                            View
                        </th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($learners as $learner)
                    <tr class="group border-b border-slate-200 duration-300">
                        <td class="px-8 py-3 font-semibold">
                            {{ $loop->iteration + ($learners->currentPage()-1)*$learners->perPage() }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img
                                    src="https://ui-avatars.com/api/?background=4f46e5&color=fff&size=200&name={{ urlencode($learner->user->name) }}"
                                    class="w-12 h-12 rounded-2xl shadow-lg group-hover:scale-110 duration-300">
                                <div>
                                    <h3 class="font-bold text-slate-800">
                                        {{ $learner->user->name }}
                                    </h3>
                                    <p class="text-sm text-slate-500">
                                        Learner Account
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-slate-600">
                            {{ $learner->user->email }}
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-slate-700">
                                {{ $learner->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">

                            @if($learner->user->id == auth()->id())
                            <a href="{{ route('instructor.learner.profile', [
                                        'course' => $course,
                                        'user' => $learner->user
                                    ]) }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                                bg-indigo-600 text-white font-semibold
                                hover:bg-indigo-700 transition-all duration-300
                                shadow-lg hover:shadow-indigo-200">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                </svg>

                                View

                            </a>
                            @else
                            <span
                                class="inline-flex items-center gap-2  px-4 py-2 rounded-full bg-emerald-100 text-emerald-600 font-semibold">
                                <span
                                    class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse">
                                </span>
                                Active
                            </span>
                            @endif
                        </td>
                        @if(auth()->user()->role == 2)
                        <td class="px-8 py-6 text-center">
                            <a href="{{ route('instructor.learner.profile', [
                                        'course' => $course,
                                        'user' => $learner->user
                                    ]) }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                                bg-indigo-600 text-white font-semibold
                                hover:bg-indigo-700 transition-all duration-300
                                shadow-lg hover:shadow-indigo-200">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                </svg>

                                View

                            </a>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="py-20 text-center">
                                <div class="text-7xl mb-5">
                                    📚
                                </div>
                                <h2 class="text-2xl font-black text-slate-700">
                                    No Learners Found
                                </h2>
                                <p class="text-slate-500 mt-3">
                                    Students will appear here after purchasing this course.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- mobile card  -->
        <div class="lg:hidden p-5 space-y-5">
            @forelse($learners as $learner)
            <div class="rounded-3xl border border-slate-100 bg-white shadow-lg p-5 hover:shadow-2xl hover:-translate-y-1 duration-300">
                <div class="flex items-center gap-4">
                    <img
                        src="https://ui-avatars.com/api/?background=4f46e5&color=fff&size=200&name={{ urlencode($learner->user->name) }}"
                        class="w-16 h-16 rounded-2xl">
                    <div class="flex-1">
                        <h3 class="font-bold">
                            {{ $learner->user->name }}
                        </h3>
                        <p class="text-sm text-slate-500">
                            {{ $learner->user->email }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-slate-400">
                            Purchase
                        </p>
                        <h4 class="font-semibold">
                            {{ $learner->created_at->format('d M Y') }}
                        </h4>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">
                            Status
                        </p>
                        <span
                            class="inline-flex mt-1 px-3 py-1 rounded-full bg-green-100 text-green-600 text-sm">
                            Active
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div
                class="rounded-3xl bg-white shadow-lg py-16 text-center">
                <div class="text-6xl">
                    📚
                </div>
                <h3 class="font-black text-xl mt-5">
                    No Learners
                </h3>
            </div>
            @endforelse
        </div>
    </div>
</div>
@if($learners->hasPages())
<div class="mt-10 flex justify-center">
    <div class="bg-white/80 backdrop-blur-xl border border-white rounded-3xl shadow-xl p-3">
        {{ $learners->links() }}
    </div>
</div>
@endif



@endsection