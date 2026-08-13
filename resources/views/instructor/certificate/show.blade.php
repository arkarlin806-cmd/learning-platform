@extends('layout.course_ins')
@section("title","Certificate")
@section("page","Show certificate.")

@section('content')


<div class="max-w-6xl mx-auto ">


    <div class="flex justify-between mb-6">


        <h1 class="text-3xl ">
            <span class="font-bold">
                Certificate</span>
            @if(auth()->user()->role != 2)
            <p class="text-sm text-slate-600">Learner show certificate and download certificate.</p>
            @else
            <p class="text-sm text-slate-600">Instructor show learner certificate.</p>
            @endif
        </h1>

        @if(auth()->user()->role != 2)
        <a
            href="{{ route('instructor.certificates.pdf',$certificate->id) }}"
            class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold ">
            Download PDF
        </a>
        @endif

    </div>




    <div
        class="relative aspect-[1.414/1] overflow-hidden rounded-xl shadow-2xl bg-white/60">

        {{-- Background --}}
        @if($certificate->frame->background)
        <div class="absolute inset-[28px] z-0 overflow-hidden">
            <img
                src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'background'
        ]) }}"
                class="w-full h-full object-cover">
        </div>
        @endif


        {{-- Watermark --}}
        @if($certificate->frame->watermark)
        <div class="absolute top-50 left-86 z-10 overflow-hidden">
            <img
                src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'watermark'
        ]) }}"
                class="w-100 h-100 object-contain opacity-10">
        </div>
        @endif


        {{-- Content --}}

        <div
            class="relative z-20 text-center pt-42 ">
            <h1 class="text-4xl font-bold" style="color:{{ $certificate->frame->primary_color }}">
                Certificate Of Completion
            </h1>
            <p class="text-xl font-serif font-semibold mt-4">AI Power Learing Platform</p>
            <h2 class="text-5xl mt-8 font-serif" style="color:{{ $certificate->frame->secondary_color }}">
                {{ $certificate->user->name }}
            </h2>
            <p class=" mt-6 text-md text-slate-800">
                has successfully completed
            </p>




            <h3 class="text-3xl font-semibold mt-5" style="color:{{ $certificate->frame->accent_color }}">

                {{ $certificate->course->title }}

            </h3>




            <p class="mt-5 text-lg font-semibold">

                {{ $certificate->description }}

            </p>



        </div>
        {{-- QR --}}

        @if($certificate->qr_code)
        <img
            src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'qr'
        ]) }}"
            class="absolute bottom-30 right-30 w-18 z-40 ">
        @endif

        {{-- Signature --}}

        @if($certificate->signature)
        <img
            src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'signature'
        ]) }}"
            class="absolute bottom-48 left-40 w-32 z-10 ">

        @endif

        @if($certificate->frame->logo)

        <img
            src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'logo'
        ]) }}"
            class="absolute top-24 left-24 w-26 z-10 ">
        @endif
        <div class="absolute text-sm bottom-30 left-30 z-10 text-slate-600">
            Instrucor :
            <span class="font-semibold">
                {{ $certificate->instructor->name }}
            </span>
            <br>
            Certificate ID:
            <span class="font-semibold">
                {{ $certificate->certificate_id }}
            </span>
            <br>
            Issued:
            <span class="font-semibold">
                {{ $certificate->issued_at->format('d M Y') }}
            </span>
        </div>

        @if($certificate->frame->seal)
        <img
            src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'seal'
        ]) }}"
            class="absolute bottom-20 right-122 w-34 z-50 ">
        @endif
        {{-- Border PNG --}}
        @if($certificate->frame->border_image)
        <img
            src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'border'
        ]) }}"
            class="absolute inset-0 w-full h-full object-fill z-10 pointer-events-none">
        @endif

    </div>




</div>


@endsection