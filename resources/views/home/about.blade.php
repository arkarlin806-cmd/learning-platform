@extends('layout.master')

@section('content')
<!-- Hero Section -->
<section class="py-12 text-center max-w-4xl mx-auto px-6">
    <span class="inline-block bg-indigo-100 text-brandPrimary text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider mb-4">
        About Our Platform
    </span>
    <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
        {{ $hero['title'] }}
    </h1>
    <p class="text-slate-600 text-base md:text-lg leading-relaxed">
        {{ $hero['description'] }}
    </p>
</section>

<!-- For Learners Section -->
<section class="py-4 max-w-7xl mx-auto px-6">
    <div class="bg-white/60 rounded-3xl p-8 md:p-12 shadow-sm border border-slate-200/80 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

        <!-- Student / Learner SVG Vector -->
        <div class="md:col-span-5 bg-indigo-50/80 rounded-2xl p-6 flex justify-center items-center">
            <svg class="w-full h-64 md:h-80" viewBox="0 0 300 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="130" r="100" fill="#E0E7FF" />
                <rect x="90" y="150" width="120" height="70" rx="8" fill="#1E293B" />
                <rect x="98" y="158" width="104" height="54" rx="4" fill="#6366F1" />
                <path d="M75 220H225L215 226H85L75 220Z" fill="#94A3B8" />
                <circle cx="150" cy="90" r="30" fill="#FDBA74" />
                <path d="M125 85C125 65 140 55 150 55C165 55 175 65 175 85C175 90 170 80 150 80C135 80 125 90 125 85Z" fill="#334155" />
                <circle cx="142" cy="88" r="8" stroke="#1E293B" stroke-width="3" fill="none" />
                <circle cx="158" cy="88" r="8" stroke="#1E293B" stroke-width="3" fill="none" />
                <line x1="150" y1="88" x2="150" y2="88" stroke="#1E293B" stroke-width="3" />
                <path d="M110 55L150 35L190 55L150 70L110 55Z" fill="#1E293B" />
                <rect x="145" y="32" width="10" height="8" fill="#F59E0B" />
                <path d="M115 150C115 120 185 120 185 150V160H115V150Z" fill="#4F46E5" />
            </svg>
        </div>

        <!-- Content -->
        <div class="md:col-span-7 space-y-6">
            <span class="text-brandPrimary font-bold text-sm uppercase tracking-wider bg-indigo-50 px-3 py-1 rounded-md">
                {{ $learners['tagline'] }}
            </span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900">
                {{ $learners['title'] }}
            </h2>
            <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                {{ $learners['description'] }}
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                @foreach($learners['features'] as $feature)
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                    <h3 class="font-bold text-slate-900 text-lg mb-1"> ✓ {{ $feature['title'] }}</h3>
                    <p class="text-md text-slate-500 leading-normal">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- For Instructors Section -->
<section class="py-4 max-w-7xl mx-auto px-6">
    <div class="bg-white/60 rounded-3xl p-8 md:p-12 shadow-sm border border-slate-200/80 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

        <!-- Content -->
        <div class="md:col-span-7 space-y-6 order-2 md:order-1">
            <span class="text-brandAccent font-bold text-xs uppercase tracking-wider bg-emerald-50 px-3 py-1 rounded-md">
                {{ $instructors['tagline'] }}
            </span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900">
                {{ $instructors['title'] }}
            </h2>
            <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                {{ $instructors['description'] }}
            </p>

            <div class="space-y-3 pt-2">
                @foreach($instructors['features'] as $feature)
                <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 flex items-start space-x-3">
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg">★ {{ $feature['title'] }}</h3>
                        <p class="text-md text-slate-500 mt-0.5">{{ $feature['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Teacher / Instructor SVG Vector -->
        <div class="md:col-span-5 bg-emerald-50/80 rounded-2xl p-6 flex justify-center items-center order-1 md:order-2">
            <svg class="w-full h-64 md:h-80" viewBox="0 0 300 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="130" r="100" fill="#D1FAE5" />
                <rect x="60" y="40" width="180" height="110" rx="10" fill="#065F46" />
                <rect x="68" y="48" width="164" height="94" rx="6" fill="#047857" />
                <path d="M80 80L110 60M80 110H140" stroke="#A7F3D0" stroke-width="4" stroke-linecap="round" />
                <circle cx="190" cy="150" r="26" fill="#FDBA74" />
                <path d="M170 145C170 125 210 125 210 145Z" fill="#1F2937" />
                <path d="M150 220C150 185 230 185 230 220V230H150V220Z" fill="#059669" />
                <line x1="120" y1="110" x2="175" y2="160" stroke="#F59E0B" stroke-width="5" stroke-linecap="round" />
            </svg>
        </div>

    </div>
</section>

<!-- Mission Section -->
<section class="py-8 max-w-6xl mx-auto px-6">
    <div class="bg-slate-900 dark:bg-white text-white rounded-3xl p-8 md:p-12 text-center shadow-xl">
        <span class="text-brandAccent font-bold text-xs uppercase tracking-widest block mb-3">Our Core Mission</span>
        <blockquote class="text-lg md:text-2xl font-bold leading-relaxed mb-4 text-slate-100">
            "{{ $mission['statement'] }}"
        </blockquote>
        <p class="text-slate-400 text-sm">— {{ $mission['author'] }}</p>
    </div>
</section>


@endsection