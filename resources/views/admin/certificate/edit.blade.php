@extends('layout.admin')
@section('page_title','Certificate')
@section('page','Admin analysis and show certificates.')
@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Edit Certificate Frame
            </h1>
            <p class="text-slate-500 mt-1">
                Update your certificate frame and preview changes instantly.
            </p>
        </div>
        <a href="{{ route('admin.certificate.frames.index') }}"
            class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">

            ← Back
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 rounded-xl bg-green-100 text-green-700 p-4">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="mb-6 rounded-xl bg-red-100 text-red-700 p-4">
        <ul class="list-disc ml-6">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST"
        action="{{ route('admin.certificate-frames.update',$certificateFrame->id) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- ========================= -->
            <!-- LEFT -->
            <!-- ========================= -->

            <div class="space-y-7">

                <!-- Category -->

                <div>

                    <label class="block font-semibold mb-2">
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category',$certificateFrame->category) }}"
                        class="w-full rounded-xl border-slate-300">

                </div>

                <!-- Frame Name -->

                <div>

                    <label class="block font-semibold mb-2">
                        Frame Name
                    </label>

                    <input
                        id="frame_name"
                        type="text"
                        name="frame_name"
                        value="{{ old('frame_name',$certificateFrame->frame_name) }}"
                        class="w-full rounded-xl border-slate-300">

                </div>

                <!-- Background -->

                <div>

                    <label class="block font-semibold mb-2">
                        Background Image
                    </label>

                    <input
                        id="background"
                        type="file"
                        name="background"
                        accept="image/*"
                        class="w-full rounded-xl border p-3">

                    @if($certificateFrame->background)

                    <img
                        src="{{ asset('storage/'.$certificateFrame->background) }}"
                        class="mt-3 h-24 rounded-lg border">

                    @endif

                </div>

                <!-- Border -->

                <div>

                    <label class="block font-semibold mb-2">
                        Border Image
                    </label>

                    <input
                        id="border_image"
                        type="file"
                        name="border_image"
                        accept="image/*"
                        class="w-full rounded-xl border p-3">

                    @if($certificateFrame->border_image)

                    <img
                        src="{{ asset('storage/'.$certificateFrame->border_image) }}"
                        class="mt-3 h-24 rounded-lg border">

                    @endif

                </div>

                <!-- Watermark -->

                <div>

                    <label class="block font-semibold mb-2">
                        Watermark
                    </label>
                    <input
                        id="watermark"
                        type="file"
                        name="watermark"
                        accept="image/*"
                        class="w-full rounded-xl border p-3">

                    @if($certificateFrame->watermark)

                    <img
                        src="{{ asset('storage/'.$certificateFrame->watermark) }}"
                        class="mt-3 h-24 rounded-lg border">

                    @endif

                </div>

                <!-- Logo -->

                <div>

                    <label class="block font-semibold mb-2">
                        Logo
                    </label>

                    <input
                        id="logo"
                        type="file"
                        name="logo"
                        accept="image/*"
                        class="w-full rounded-xl border p-3">

                    @if($certificateFrame->logo)

                    <img
                        src="{{ asset('storage/'.$certificateFrame->logo) }}"
                        class="mt-3 h-24 rounded-lg border">

                    @endif

                </div>

                <!-- Seal -->

                <div>

                    <label class="block font-semibold mb-2">
                        Seal
                    </label>

                    <input
                        id="seal"
                        type="file"
                        name="seal"
                        accept="image/*"
                        class="w-full rounded-xl border p-3">

                    @if($certificateFrame->seal)

                    <img
                        src="{{ asset('storage/'.$certificateFrame->seal) }}"
                        class="mt-3 h-24 rounded-lg border">

                    @endif

                </div>

                <!-- Colors -->

                <div class="grid grid-cols-3 gap-4">

                    <div>

                        <label class="block font-semibold mb-2">
                            Primary
                        </label>

                        <input
                            id="primary_color"
                            type="color"
                            name="primary_color"
                            value="{{ old('primary_color',$certificateFrame->primary_color) }}"
                            class="w-full h-12 rounded-lg">

                    </div>

                    <div>

                        <label class="block font-semibold mb-2">
                            Secondary
                        </label>

                        <input
                            id="secondary_color"
                            type="color"
                            name="secondary_color"
                            value="{{ old('secondary_color',$certificateFrame->secondary_color) }}"
                            class="w-full h-12 rounded-lg">

                    </div>

                    <div>

                        <label class="block font-semibold mb-2">
                            Accent
                        </label>

                        <input
                            id="accent_color"
                            type="color"
                            name="accent_color"
                            value="{{ old('accent_color',$certificateFrame->accent_color) }}"
                            class="w-full h-12 rounded-lg">

                    </div>

                </div>

                <!-- Active -->

                <div class="flex items-center gap-3">

                    <input
                        id="active"
                        type="checkbox"
                        name="active"
                        value="1"
                        {{ $certificateFrame->active ? 'checked' : '' }}
                        class="h-5 w-5">

                    <label class="font-semibold">

                        Active Frame

                    </label>

                </div>

                <!-- Submit -->
                <button
                    class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition">

                    Update Certificate Frame

                </button>

            </div>
            <!-- ========================= -->
            <!-- RIGHT -->
            <!-- ========================= -->

            <div>

                <h2 class="text-2xl font-bold text-slate-800 mb-5">
                    Live Preview
                </h2>

                <div
                    id="certificatePreview"
                    class="relative aspect-[1.414/1] bg-white rounded-2xl shadow-2xl overflow-hidden border">

                    <!-- Background -->

                    <img
                        id="previewBackground"
                        src="{{ $certificateFrame->background ? asset('storage/'.$certificateFrame->background) : '' }}"
                        class="absolute inset-0 w-full h-full object-cover {{ $certificateFrame->background ? '' : 'hidden' }}">

                    <!-- Watermark -->

                    <img
                        id="previewWatermark"
                        src="{{ $certificateFrame->watermark ? asset('storage/'.$certificateFrame->watermark) : '' }}"
                        class="absolute inset-0 w-full h-full object-contain opacity-10 {{ $certificateFrame->watermark ? '' : 'hidden' }}">

                    <!-- Logo -->

                    <img
                        id="previewLogo"
                        src="{{ $certificateFrame->logo ? asset('storage/'.$certificateFrame->logo) : '' }}"
                        class="absolute top-12 left-12 w-16 z-40 {{ $certificateFrame->logo ? '' : 'hidden' }}">

                    <!-- Seal -->

                    <img
                        id="previewSeal"
                        src="{{ $certificateFrame->seal ? asset('storage/'.$certificateFrame->seal) : '' }}"
                        class="absolute bottom-8 right-55 w-20 z-40 {{ $certificateFrame->seal ? '' : 'hidden' }}">

                    <!-- Certificate Content -->

                    <div class="relative z-30 flex flex-col  py-12 h-full px-12 text-center">

                        <h1
                            id="previewTitle"
                            class="text-xl font-bold mt-4"
                            style="color:{{ $certificateFrame->primary_color }}">

                            CERTIFICATE OF COMPLETION

                        </h1>

                        <p class="mt-1 text-slate-600 text-lg">
                            AI Power Learing Platform
                        </p>

                        <h2
                            id="previewName"
                            class="mt-2 text-2xl font-serif"
                            style="color:{{ $certificateFrame->secondary_color }}">

                            John Doe

                        </h2>

                        <p
                            id="previewCourse"
                            class="mt-3 text-sm text-slate-500">

                            has Successfully completed

                            <br>

                            <strong style="color:{{ $certificateFrame->accent_color }}">Course</strong>

                        </p>

                        <p
                            id="previewDescription"
                            class="mt-5 text-sm text-slate-600 max-w-xl">

                            Great A.

                        </p>

                        <!-- Bottom -->

                        <div class="absolute bottom-10 left-12 right-12 flex justify-between items-end">

                            <!-- Signature -->

                            <div class="text-center">

                                <div class="w-20 border-b border-slate-500 mb-2"></div>

                                <p class="text-sm ">

                                    Signature

                                </p>

                            </div>

                            <!-- Certificate ID -->

                            <!-- <div class="text-center">
                                <p class="text-xs text-slate-500">

                                    Certificate ID

                                </p>

                                <p class="font-bold">

                                    CERT-000001

                                </p>

                            </div> -->

                            <!-- QR -->

                            <div class="text-center">

                                <div class="w-16 h-16 bg-slate-200 rounded-lg flex items-center justify-center">

                                    QR

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Border -->

                    <img
                        id="previewBorder"
                        src="{{ $certificateFrame->border_image ? asset('storage/'.$certificateFrame->border_image) : '' }}"
                        class="absolute inset-0 w-full h-full object-fill pointer-events-none z-50 {{ $certificateFrame->border_image ? '' : 'hidden' }}">

                </div>

            </div>

        </div>

    </form>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const preview = {
            background: document.getElementById("previewBackground"),
            border: document.getElementById("previewBorder"),
            watermark: document.getElementById("previewWatermark"),
            logo: document.getElementById("previewLogo"),
            seal: document.getElementById("previewSeal"),

            title: document.getElementById("previewTitle"),
            name: document.getElementById("previewName"),
            course: document.getElementById("previewCourse"),
            description: document.getElementById("previewDescription")
        };

        //==============================
        // Image Preview
        //==============================

        function previewImage(inputId, imageId) {
            const input = document.getElementById(inputId);

            if (!input) return;

            input.addEventListener("change", function() {

                if (!this.files.length) return;

                const file = this.files[0];

                const reader = new FileReader();

                reader.onload = function(e) {

                    const img = document.getElementById(imageId);

                    img.src = e.target.result;

                    img.classList.remove("hidden");
                };

                reader.readAsDataURL(file);

            });
        }

        previewImage("background", "previewBackground");
        previewImage("border_image", "previewBorder");
        previewImage("watermark", "previewWatermark");
        previewImage("logo", "previewLogo");
        previewImage("seal", "previewSeal");



        //==============================
        // Color Preview
        //==============================

        const primaryColor = document.getElementById("primary_color");
        const secondaryColor = document.getElementById("secondary_color");
        const accentColor = document.getElementById("accent_color");

        function updateColors() {
            if (primaryColor) {
                preview.title.style.color = primaryColor.value;
            }

            if (secondaryColor) {
                preview.name.style.color = secondaryColor.value;
            }

            if (accentColor) {
                preview.course.style.color = accentColor.value;
                preview.description.style.color = accentColor.value;
            }
        }

        if (primaryColor) {
            primaryColor.addEventListener("input", updateColors);
        }

        if (secondaryColor) {
            secondaryColor.addEventListener("input", updateColors);
        }

        if (accentColor) {
            accentColor.addEventListener("input", updateColors);
        }

        updateColors();



        //==============================
        // Live Text
        //==============================

        const frameName = document.getElementById("frame_name");

        if (frameName) {
            frameName.addEventListener("input", function() {

                document.title = this.value;

            });
        }



        //==============================
        // Active Toggle
        //==============================

        const active = document.getElementById("active");

        if (active) {
            active.addEventListener("change", function() {

                if (this.checked) {
                    preview.border.style.opacity = "1";
                } else {
                    preview.border.style.opacity = ".35";
                }

            });
        }



        //==============================
        // Load Current Images
        //==============================

        [
            "previewBackground",
            "previewBorder",
            "previewWatermark",
            "previewLogo",
            "previewSeal"
        ].forEach(function(id) {

            const img = document.getElementById(id);

            if (img && img.src) {
                img.classList.remove("hidden");
            }

        });



        //==============================
        // Reset Hidden
        //==============================

        document.querySelectorAll("img").forEach(function(img) {

            img.onerror = function() {

                this.classList.add("hidden");

            }

        });

    });
</script>
@endsection