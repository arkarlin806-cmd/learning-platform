@extends('layout.admin')
@section('page_title','Certificate Designer')
@section('page','Admin Create Certificate Frame')
@section('content')
<form
    action="{{ route('admin.certificate.frames.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <div class="xl:col-span-4">
            <div class="bg-white rounded-3xl shadow-xl p-6 h-[calc(100vh-120px)] overflow-y-auto space-y-6 ">
                <h1 class="text-2xl font-black">
                    🎨 Certificate Frame
                </h1>
                @php
                $c = [
                "Backend Language",
                "Frontend Language",
                "Web Development",
                "Mobile Development",
                "Artificial Intelligence",
                "Data Science",
                "Cyber Security",
                "UI/UX Design",
                "Graphic Design",
                "Business",
                "Photography",
                "Video Editing",
                "Language",
                "Other"
                ];
                @endphp

                <!-- BASIC -->
                <div>
                    <label class="font-semibold text-slate-600">
                        Category
                    </label>
                    <select required
                        name="category" class="w-full mt-2 rounded-xl border border-slate-300 py-3 px-3 bg-slate-100">
                        @foreach ($c as $cg )
                        <option>{{ $cg }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-semibold text-slate-600">
                        Frame Name
                    </label>
                    <input
                        name="frame_name" required
                        class="w-full mt-2 rounded-xl  border border-slate-300 py-2 px-3 bg-slate-100"
                        placeholder="Premium Gold Certificate">
                </div>


                <!-- upload -->
                <div class="border-t pt-5">
                    <h2 class="font-bold text-lg mb-4">
                        🖼 Assets
                    </h2>
                    @foreach([
                    'background'=>'Background',
                    'border_image'=>'border',
                    'logo'=>'Logo',
                    'seal'=>'Seal',
                    'watermark'=>'Watermark',
                    ] as $key=>$label)

                    <div class="mb-5">
                        <label class="text-sm font-semibold text-slate-600">
                            {{ $label }}
                        </label>
                        <input
                            type="file" required
                            name="{{ $key }}"
                            data-preview="{{ $key }}Preview"
                            class="preview-input w-full mt-2 text-sm border border-slate-300 py-2 px-3 bg-slate-100 rounded-lg">
                    </div>

                    @endforeach
                </div>

                <!-- COLORS -->
                <div class="border-t pt-5">
                    <h2 class="font-bold mb-4">
                        🎨 Colors
                    </h2>
                    <div class="grid grid-cols-2 gap-3">

                        <label for="" class="flex items-center px-2 text-slate-600">Title
                            <input
                                type="color"
                                name="primary_color"
                                value="#030303"
                                class="color-input h-12 ml-5 rounded-xl"></label>

                        <label for="" class="flex items-center px-2 text-slate-600">Name
                            <input
                                type="color"
                                name="secondary_color"
                                value="#030303"
                                class="color-input h-12 ml-2 rounded-xl"></label>

                        <label for="" class="flex items-center px-2 text-slate-600">Course
                            <input
                                type="color"
                                name="accent_color"
                                value="#030303"
                                class="color-input h-12 ml-1 rounded-xl"></label>


                    </div>
                </div>


                <!-- OPTIONS -->
                <div class="border-t pt-5">
                    <h2 class="font-bold mb-4">
                        ⚙ Display
                    </h2>

                    @foreach([
                    'show_logo'=>'Logo',
                    'show_seal'=>'Seal',
                    'show_qr'=>'QR',
                    'show_watermark'=>'Watermark',
                    'show_certificate_id'=>'Certificate ID'
                    ] as $field=>$label)

                    <label class="flex justify-between mb-3 ">
                        <span>
                            {{ $label }}
                        </span>

                        <input
                            type="checkbox"
                            name="{{ $field }}"
                            checked
                            value="1">
                    </label>

                    @endforeach
                </div>


                <button
                    type="submit"
                    onclick="saveLayout()"
                    class="w-full py-4 rounded-2xl bg-indigo-600 text-white font-bold">
                    Create Frame
                </button>
            </div>
        </div>


        <!-- Right live section  -->
        <div class="xl:col-span-8">
            <div class="sticky top-6 bg-white rounded-3xl shadow-xl p-6 ">
                <div class="flex justify-between mb-5">
                    <h2 class="text-xl font-bold">
                        Live Preview
                    </h2>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full animate-pulse ">
                        LIVE
                    </span>
                </div>

                <!-- CANVAS -->
                <div
                    id="certificateCanvas"
                    class="relative w-full aspect-[1.414/1] overflow-hidden rounded-xl shadow-2xl bg-white">

                    <!-- BACKGROUND -->
                    <img
                        id="backgroundPreview" class="w-full h-full"
                        style="
                            position:absolute;
                            
                            object-fit:fill;
                            z-index:1;
                            display:none;
                            ">
                    <!-- TEXT -->
                    <h1
                        id="titlePreview"
                        data-element="title"
                        class="absolute top-[25%] w-full text-center text-3xl font-black z-20 ">

                        Certificate Of Completion
                    </h1>
                    <h2
                        id="namePreview"
                        data-element="name"
                        class="absolute top-[45%] w-full text-center text-3xl font-serif z-20 ">
                        Learner Name
                    </h2>
                    <p
                        id="coursePreview"
                        data-element="course"
                        class="absolute top-[65%] w-full text-center text-xl z-20 ">
                        Course Name
                    </p>

                    <!-- LOGO -->
                    <img
                        id="logoPreview"
                        class="absolute top-14 left-14 w-18 z-30 hidden ">


                    <!-- SEAL -->
                    <img
                        id="sealPreview"
                        class="absolute bottom-4 right-70 w-28 z-30 hidden ">

                    <!-- WATERMARK -->
                    <img
                        id="watermarkPreview"
                        class="absolute left-1/2 top-1/2 w-72 opacity-10 -translate-x-1/2 -translate-y-1/2 z-10 hidden ">

                    <!-- BORDER LAST -->
                    <img
                        id="border_imagePreview" class="w-full h-full"
                        style="
                            position:absolute;
                            z-index:100;
                            display:none;
                            pointer-events:none;
                            ">

                    <div
                        id="qrPreview"
                        class="absolute bottom-14 right-14 w-16 h-16 border-2 border-dashed z-40 flex items-center justify-center text-xs ">
                        QR
                    </div>

                    <div
                        id="certificateIdPreview"
                        class="absolute bottom-13 left-12 text-xs z-40 ">
                        CERT-2026-XXXX
                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    document
        .querySelectorAll(".preview-input")
        .forEach(input => {

            input.addEventListener(
                "change",
                function(e) {

                    let file =
                        e.target.files[0];

                    if (!file) {
                        return;
                    }

                    let previewId =
                        this.dataset.preview;

                    let preview =
                        document.getElementById(
                            previewId
                        );

                    if (!preview) {
                        console.log("Not found:", previewId);
                        return;
                    }

                    let reader =
                        new FileReader();

                    reader.onload = function(event) {

                        preview.src =
                            event.target.result;

                        preview.style.display =
                            "block";
                        preview.classList.remove(
                            "hidden"
                        );

                        console.log(
                            "Loaded:",
                            previewId
                        );
                    }
                    reader.readAsDataURL(file);
                });
        });

    // select         
    let selectedElement = null;
    document
        .querySelectorAll("[data-element]")
        .forEach(element => {
            element.addEventListener(
                "click",
                function(e) {
                    e.stopPropagation();
                    document
                        .querySelectorAll("[data-element]")
                        .forEach(el => {

                            el.classList.remove(
                                "ring-4",
                                "ring-indigo-400"
                            );

                        });

                    selectedElement = this;
                    this.classList.add(
                        "ring-4",
                        "ring-indigo-400"
                    );
                }
            );
        });


    // COLOR UPDATE
    document
        .querySelectorAll(".color-input")
        .forEach(input => {
            input.addEventListener(
                "input",
                function() {
                    let canvas =
                        document.getElementById(
                            "certificateCanvas"
                        );
                    if (
                        selectedElement &&
                        selectedElement.tagName !== "IMG"
                    ) {
                        selectedElement.style.color =
                            this.value;
                    }
                });
        });


    //  DISPLAY TOGGLE
    let toggleMap = {
        show_logo: "logoPreview",
        show_seal: "sealPreview",
        show_watermark: "watermarkPreview",
    };

    Object.keys(toggleMap)
        .forEach(key => {
            let checkbox =
                document.querySelector(
                    input[name = "${key}"]
                );
            if (checkbox) {
                checkbox.addEventListener(
                    "change",
                    function() {
                        let element =
                            document.getElementById(
                                toggleMap[key]
                            );
                        if (this.checked) {

                            element.classList.remove(
                                "hidden"
                            );

                        } else {

                            element.classList.add(
                                "hidden"
                            );

                        }

                    }

                );

            }

        });
</script>

@endsection