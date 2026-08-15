@extends('layout.course_ins')
@section("title","Certificate")
@section("page","Instructor create certificate.")

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <div class="">
        <h1 class="text-3xl font-bold text-slate-800 mb-2 ">
            Create Certificate
        </h1>
        <p class="text-slate-500 mb-4">
            Course:
            <span class="font-semibold text-indigo-600">
                {{ $course->title }}
            </span>
        </p>


    </div>
    <div class="">
        <form
            method="POST"
            action="{{ route('instructor.certificates.store',$course->id) }}"
            enctype="multipart/form-data">

            @csrf
            <div class="grid lg:grid-cols-2 gap-8">

                <!-- LEFT FORM  -->
                <div class="space-y-6 bg-white border border-slate-300 rounded-2xl p-6">

                    <!-- Learner -->
                    <div>
                        <label class="font-semibold text-slate-700">
                            Select Learner
                        </label>
                        <select
                            name="user_id"
                            class="mt-2 w-full rounded-xl py-3 bg-slate-100 px-3 border border-slate-300" required>
                            <option value="">
                                Choose learner
                            </option>
                            @foreach($learners as $learner)
                            <option value="{{ $learner->user->id }}">
                                {{ $learner->user->name }}
                                ({{ $learner->user->email }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Frame --}}
                    <div>
                        <label class="font-semibold">
                            Certificate Frame
                        </label>
                        <select name="certificate_frame_id" required
                            id="frameSelect" class="mt-2 w-full rounded-xl py-3 bg-slate-100 px-3 border border-slate-300">
                            <option value="">
                                Select frame
                            </option>

                            @foreach($frames as $frame)
                            <option
                                value="{{ $frame->id }}"
                                data-background="{{ $frame->background_url ?? '' }}"
                                data-border="{{ $frame->border_url ?? '' }}"
                                data-watermark="{{ $frame->watermark_url ?? '' }}"
                                data-logo="{{ $frame->logo_url ?? '' }}"
                                data-seal="{{ $frame->seal_url ?? '' }}">
                                {{ $frame->frame_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description  -->
                    <div>
                        <label class="font-semibold">
                            Description
                            <span class="text-xs text-slate-400">
                                (Max 15 words)
                            </span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            class="mt-2 w-full rounded-xl py-3 bg-slate-100 px-3 border border-slate-300"
                            placeholder="Successfully completed Laravel course">
                        </textarea>

                        <p id="wordCount"
                            class="text-sm text-slate-500">
                            0 / 15 words
                        </p>
                    </div>

                    {{-- Signature --}}
                    <div>
                        <label class="font-semibold">
                            Instructor Signature
                        </label>
                        <input
                            type="file"
                            name="signature"
                            id="signature"
                            accept="image/*"
                            class="mt-2 w-full rounded-xl py-3 bg-slate-100 px-3 border border-slate-300 ">
                    </div>

                    <button
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold hover:scale-105 transition">
                        Issue Certificate
                    </button>
                </div>

                {{-- RIGHT PREVIEW --}}
                <div>
                    <h2 class="text-xl font-bold mb-4 ">
                        Live Preview
                    </h2>
                    <div
                        class="relative aspect-[1.414/1] h-120 w-145 overflow-hidden rounded-xl shadow-lg bg-white "
                        id="certificatePreview">

                        {{-- Background --}}
                        <img
                            id="previewBackground"
                            class="absolute inset-0 w-full h-full object-cover z-0 hidden ">

                        {{-- Watermark --}}
                        <img
                            id="previewWatermark"
                            class="absolute inset-0 w-50 h-50 left-50 top-30 object-contain opacity-10 z-10 hidden ">


                        {{-- Content --}}
                        <div
                            class="relative z-20 text-center pt-22 px-10 ">

                            <h1
                                class="text-2xl font-bold text-slate-800">
                                Certificate Of Completion
                            </h1>
                            <h2
                                class="mt-8 text-3xl font-serif text-indigo-600 ">
                                Learner Name
                            </h2>
                            <p class="mt-5 text-slate-600 ">
                                {{ $course->title }}
                            </p>
                            <p
                                id="previewDescription"
                                class="mt-5 text-sm text-slate-500 ">
                                Description
                            </p>
                        </div>

                        {{-- Border PNG Frame --}}
                        <img
                            id="previewBorder"
                            class="absolute inset-0 w-full h-full object-fill z-30 pointer-events-none hidden ">

                        {{-- Logo --}}
                        <img
                            id="previewLogo"
                            class="absolute top-12 left-12 w-20 z-50 hidden ">

                        {{-- Seal --}}
                        <img
                            id="previewSeal"
                            class="absolute bottom-10 right-60 w-24 z-50 hidden ">

                        {{-- Logo --}}
                        <img
                            id="previewLogo"
                            class="absolute top-18 left-14 w-18 z-40 hidden ">

                        {{-- Signature --}}
                        <img
                            id="previewSignature"
                            class="absolute bottom-22 left-20 w-28 z-50 hidden ">

                        <div
                            id="qrPreview"
                            class="absolute bottom-14 right-14 w-16 h-16 border-2 border-dashed z-40 flex items-center justify-center text-xs ">
                            QR
                        </div>

                        <div
                            id="certificateIdPreview"
                            class="absolute bottom-14 left-14 text-xs z-40 ">
                            CERT-2026-XXXX
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const frameSelect =
        document.getElementById('frameSelect');

    frameSelect.addEventListener(
        'change',
        function() {


            let option =
                this.options[this.selectedIndex];



            showImage(
                'previewBackground',
                option.dataset.background
            );



            showImage(
                'previewBorder',
                option.dataset.border
            );



            showImage(
                'previewWatermark',
                option.dataset.watermark
            );

            showImage(
                'previewSeal',
                option.dataset.seal
            );

            showImage(
                'previewLogo',
                option.dataset.logo
            );



        });

    function showImage(id, url) {


        let img =
            document.getElementById(id);



        if (url) {

            img.src = url;

            img.classList.remove('hidden');

        } else {

            img.classList.add('hidden');

        }


    }


    // Signature Preview
    document
        .getElementById('signature')
        .addEventListener(
            'change',
            function(e) {


                let file = e.target.files[0];


                if (file) {

                    let img =
                        document.getElementById(
                            'previewSignature'
                        );


                    img.src =
                        URL.createObjectURL(file);


                    img.classList.remove(
                        'hidden'
                    );


                }


            });


    // Description
    document
        .getElementById('description')
        .addEventListener(
            'input',
            function() {


                let words =
                    this.value
                    .trim()
                    .split(/\s+/)
                    .filter(Boolean);



                if (words.length > 15) {

                    this.value =
                        words
                        .slice(0, 15)
                        .join(" ");


                    words =
                        this.value
                        .split(/\s+/);


                }



                document
                    .getElementById('wordCount')
                    .innerHTML =
                    words.length + " / 15 words";



                document
                    .getElementById('previewDescription')
                    .innerHTML =
                    this.value;


            });
</script>


@endsection