@extends('layout.course_ins')
@section("title","Lesson")
@section("page","All Lesson Show and Lesson Summaries Show.")

@section('content')

<div class="text-center mb-12" data-aos="fade-up">
    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/70 backdrop-blur-md border border-white shadow-sm text-sm font-semibold text-indigo-600">
        ✨ Certificagte
    </span>

    <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-800">
        Your certificate
        <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
            not found
        </span>
    </h1>

    <p class="mt-4 max-w-2xl mx-auto text-slate-500 text-sm sm:text-base leading-7">
        Now, don't show certifcate because instrucotr this course not complete.
    </p>
</div>
@endsection