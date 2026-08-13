@extends('layout.admin')
@section('page_title','Certificate')
@section('page','Admin analysis and show certificates.')
@section('content')

<div class="min-h-screen  p-4 sm:p-6">

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <!-- LEFT INFORMATION -->

        <div class="xl:col-span-4">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-6 space-y-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        {{ $certificateFrame->frame_name }}
                    </h1>
                    <p class="text-indigo-600 mt-1">
                        {{ ucfirst($certificateFrame->category) }}
                    </p>
                </div>
                <div>
                    <h3 class="font-bold mb-2">
                        Description
                    </h3>
                    <p class="text-slate-500">

                        {{ $certificateFrame->description ?? 'No description' }}

                    </p>


                </div>
                <!-- STATUS -->
                <div class="flex justify-between">
                    <span>
                        Status
                    </span>
                    <span class="px-4 py-1 rounded-full text-sm font-bold 
                            {{ $certificateFrame->active
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700'
                            }}">
                        {{ $certificateFrame->active
                            ? 'Active'
                            : 'Inactive'
                            }}
                    </span>
                </div>





                <!-- FEATURES -->
                <div class="border-t pt-5">
                    <h3 class="font-bold mb-4">
                        ✨ Enabled Features
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @if($certificateFrame->show_logo)
                        <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">
                            Logo
                        </span>
                        @endif




                        @if($certificateFrame->show_seal)
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm"> Seal
                        </span>
                        @endif

                        <!-- qr  -->
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            QR Verification
                        </span>
                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">
                            Certificate ID
                        </span>
                    </div>
                </div>


                <!-- SETTINGS -->
                <div class="border-t pt-5">

                    <div class="py-2 flex justify-center rounded-xl px-7 py-2 bg-yellow-200"><a href="{{ route('admin.certificate-frames.edit',$certificateFrame) }}">Edit</a></div>


                </div>










            </div>


        </div>


        <!-- RIGHT CERTIFICATE PREVIEW -->
        <div class="xl:col-span-8">
            <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl p-6 ">
                <div class="flex justify-between items-center mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Certificate Preview
                        </h2>
                        <p class="text-sm text-slate-500">
                            Template rendering preview
                        </p>
                    </div>

                    <span class=" px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                        Live Preview
                    </span>
                </div>


                <!-- CERTIFICATE CANVAS -->
                <div
                    class="relative aspect-[1.414/1] overflow-hidden bg-white rounded-xl ">
                    {{-- Background Inside Frame --}}

                    @if($certificateFrame->background)
                    <img
                        src="{{ route('admin.certificate.image', ['filename' => basename($certificateFrame->background)]) }}"
                        class="absolute top-5 left-5 right-5 bottom-5 w-[calc(100%-40px)] h-[calc(100%-40px)] object-cover z-0 ">
                    @endif

                    {{-- Border PNG Full Size --}}
                    @if($certificateFrame->border_image)
                    <img
                        src="{{ route('admin.certificate.image', ['filename' => basename($certificateFrame->border_image)]) }}"
                        class="absolute inset-0 w-full h-full object-fill z-20 pointer-events-none ">
                    @endif

                    {{-- Watermark --}}

                    @if($certificateFrame->watermark)
                    <img
                        src="{{ route('admin.certificate.image', ['filename' => basename($certificateFrame->watermark)]) }}"
                        class="absolute top-1/2 left-1/2 w-80 opacity-10 -translate-x-1/2 -translate-y-1/2 z-10 ">
                    @endif

                    <!-- content area -->
                    <div
                        class="relative z-40 h-full ">

                        {{-- TITLE --}}
                        <h1
                            class="absolute top-24 w-full text-center text-4xl font-bold "
                            style="color:{{ $certificateFrame->primary_color }} ">


                            Certificate Of Completion
                        </h1>

                        <!-- LEARNER NAME  -->
                        <h2
                            class="absolute top-40 w-full text-center text-4xl font-semibold "
                            style="color:{{ $certificateFrame->secondary_color }}; ">
                            Learner Name
                        </h2>

                        <!-- COURSE NAME  -->
                        <p
                            class="absolute top-56 w-full text-center text-xl "
                            style="color: {{ $certificateFrame->accent_color ?? '#111827' }};">
                            Course Name
                        </p>
                    </div>

                    <!-- logo  -->
                    @if( $certificateFrame->logo)
                    <img
                        src="{{ route('admin.certificate.image', ['filename' => basename($certificateFrame->logo)]) }}"
                        class="absolute top-14 left-14 w-16 z-50">
                    @endif

                    <!-- seal  -->
                    @if($certificateFrame->seal)
                    <img
                        src="{{ route('admin.certificate.image', ['filename' => basename($certificateFrame->seal)]) }}"
                        class="absolute bottom-12 right-70 w-24 z-50">
                    @endif

                    <!-- Qr  -->
                    <div
                        class="absolute bottom-16 right-16 w-16 h-16 border border-dashed border-slate-400 flex items-center justify-center text-xs text-slate-400 z-50">
                        QR
                    </div>

                    <!-- id  -->
                    <div
                        class="absolute bottom-15 left-16 text-xs text-slate-600 z-50">
                        CERT-2026-XXXX
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection