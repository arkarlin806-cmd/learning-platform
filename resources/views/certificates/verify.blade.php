{{-- resources/views/certificates/verify.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Certificate Verification
    </title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-slate-50 text-slate-900">


    {{-- ================= HERO SECTION ================= --}}

    <section class="relative overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-br 
        from-indigo-700 via-purple-700 to-blue-700">
        </div>


        <div class="relative max-w-6xl mx-auto px-6 py-20">


            <div class="text-center text-white">


                <div class="inline-flex items-center gap-2 
                bg-white/20 backdrop-blur-md
                px-5 py-2 rounded-full mb-6">

                    <span class="w-3 h-3 rounded-full bg-green-400 animate-pulse"></span>

                    <span class="font-semibold">
                        Certificate Verification System
                    </span>

                </div>



                <h1 class="text-4xl md:text-6xl font-black tracking-tight">

                    Verify Certificate

                </h1>


                <p class="mt-5 text-lg text-white/80 max-w-2xl mx-auto">

                    This page confirms whether this certificate was
                    officially issued by our learning platform.

                </p>



            </div>


        </div>

    </section>




    {{-- ================= STATUS SECTION ================= --}}

    <section class="-mt-12 relative z-10">

        <div class="max-w-5xl mx-auto px-6">


            @if($certificate)


            <div class="
bg-white
rounded-3xl
shadow-2xl
border
border-slate-200
p-8
">


                <div class="flex flex-col md:flex-row 
items-center justify-between gap-6">


                    <div>


                        <h2 class="text-2xl font-bold">

                            Certificate Status

                        </h2>


                        <p class="text-slate-500 mt-2">

                            Verification result

                        </p>


                    </div>



                    <div class="
flex items-center gap-3
bg-green-50
text-green-700
px-6 py-3
rounded-full
font-bold
border border-green-200
">


                        <span class="
w-3 h-3 
bg-green-500 
rounded-full
animate-pulse
">
                        </span>


                        VALID CERTIFICATE


                    </div>


                </div>



            </div>


            @else


            <div class="
bg-white
rounded-3xl
shadow-xl
border border-red-200
p-8
">


                <div class="
flex items-center gap-4
bg-red-50
text-red-700
px-6 py-5
rounded-2xl
">


                    <div class="
w-12 h-12
rounded-full
bg-red-500
text-white
flex items-center justify-center
text-xl
font-bold
">

                        !

                    </div>


                    <div>

                        <h2 class="font-bold text-xl">

                            Certificate Invalid

                        </h2>


                        <p class="text-sm">

                            This certificate could not be verified.

                        </p>


                    </div>


                </div>


            </div>


            @endif


        </div>

    </section>





    {{-- ================= CERTIFICATE HOLDER CARD ================= --}}


    @if($certificate)

    <section class="py-12">


        <div class="max-w-5xl mx-auto px-6">


            <div class="
bg-white
rounded-3xl
shadow-xl
overflow-hidden
border
border-slate-200
">


                <div class="
bg-gradient-to-r
from-indigo-600
to-purple-600
p-8
text-white
">


                    <h2 class="text-2xl font-black">

                        Certificate Holder

                    </h2>


                    <p class="text-white/80 mt-2">

                        Official learner information

                    </p>


                </div>



                <div class="p-8">


                    <div class="
flex flex-col md:flex-row
items-center
gap-8
">



                        {{-- USER PHOTO --}}

                        <div class="
w-32 h-32
rounded-full
overflow-hidden
ring-4
ring-indigo-100
shadow-lg
">


                            <img
                                src="https://ui-avatars.com/api/?name={{ $certificate->user->name }}"


                                class="w-full h-full object-cover"

                                alt="User Avatar">

                        </div>





                        <div class="flex-1 text-center md:text-left">


                            <h3 class="text-3xl font-black">

                                {{ $certificate->user->name }}

                            </h3>


                            <p class="text-slate-500 mt-2">

                                Successfully completed

                            </p>



                            <div class="mt-5 grid md:grid-cols-2 gap-4">



                                <div class="
bg-slate-50
rounded-xl
p-4
">

                                    <p class="text-xs text-slate-500">

                                        COURSE

                                    </p>


                                    <p class="font-bold">

                                        {{ $certificate->course->title }}

                                    </p>


                                </div>




                                <div class="
bg-slate-50
rounded-xl
p-4
">

                                    <p class="text-xs text-slate-500">

                                        INSTRUCTOR

                                    </p>


                                    <p class="font-bold">

                                        {{ $certificate->instructor->name }}

                                    </p>

                                </div>




                                <div class="
bg-slate-50
rounded-xl
p-4
">

                                    <p class="text-xs text-slate-500">

                                        CERTIFICATE ID

                                    </p>


                                    <p class="font-mono font-bold">

                                        {{ $certificate->certificate_id }}
                                    </p>


                                </div>





                                <div class="
bg-slate-50
rounded-xl
p-4
">

                                    <p class="text-xs text-slate-500">

                                        ISSUED DATE

                                    </p>


                                    <p class="font-bold">

                                        {{ $certificate->created_at->format('d M Y') }}

                                    </p>


                                </div>



                            </div>


                        </div>


                    </div>


                </div>


            </div>


        </div>


    </section>


    @endif
    {{-- ================= CERTIFICATE FRAME PREVIEW ================= --}}

    @if($certificate)

    <section class="py-16 bg-slate-100">


        <div class="max-w-6xl mx-auto px-6">


            <div class="text-center mb-10">


                <h2 class="text-3xl md:text-4xl font-black">

                    Certificate Preview

                </h2>


                <p class="text-slate-500 mt-3">

                    Official certificate issued by our platform

                </p>


            </div>





            {{-- A4 LANDSCAPE WRAPPER --}}

            <div class="
relative
w-full
aspect-[1.414/1]
bg-white
rounded-xl
shadow-2xl
overflow-hidden
border
border-slate-200
">



                {{-- BACKGROUND IMAGE --}}

                @if($certificate->frame->background)

                <img

                    src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'background'
        ]) }}"
                    class="
absolute
inset-0
w-full
h-full
object-cover
z-10
pointer-events-none
"

                    alt="Certificate Background">


                @endif





                {{-- BORDER PNG OVERLAY --}}

                @if($certificate->frame->border_image)


                <img

                    src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'border'
        ]) }}"

                    class="
absolute
inset-0
w-full
h-full
object-fill
z-30
pointer-events-none
"

                    alt="Certificate Border">


                @endif





                {{-- WATERMARK --}}

                @if($certificate->frame->watermark)

                <img

                    src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'watermark'
        ]) }}"
                    class="
                        absolute
                        inset-0
                        w-30 h-30 left-23 top-10
                        object-contain
                        opacity-10
                        z-20
                        pointer-events-none
                        "

                    alt="Watermark">


                @endif


                {{-- LOGO --}}

                @if($certificate->frame->logo)

                <img

                    src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'logo'
        ]) }}"

                    class="
absolute
top-7 left-8
w-10 h-10
object-contain
z-50
"

                    alt="Logo">


                @endif






                {{-- CONTENT LAYER --}}

                <div class="
                        absolute
                        inset-0
                        z-40
                        flex
                        flex-col
                        items-center
                        mt-10
                        ">









                    {{-- CERTIFICATE TITLE --}}

                    <h1

                        class="
                            font-black
                            "

                        style="
                            color: {{ $certificate->frame->primary_color ?? '#1e293b' }};
                            font-family: 'Times New Roman', Times, serif;font-size: 10px;
                            ">

                        Certificate of Completion


                    </h1>






                    {{-- DESCRIPTION --}}

                    <p class="
mt-1
text-xs
text-slate-600
" style="font-size: 8px;">

                        AI Power Learning Platform


                    </p>







                    {{-- USER NAME --}}

                    <h2

                        class="
mt-2
text-xs
font-black
font-serif
"

                        style="
color: {{ $certificate->frame->secondary_color ?? '#4f46e5' }};
">


                        {{ $certificate->user->name }}


                    </h2>






                    {{-- COURSE --}}

                    <p class="
mt-1
font-semibold
" style="font-size:6px;">

                        has successfully completed

                    </p>


                    <p class="
mt-1
font-bold
" style="
color: {{ $certificate->frame->accent_color ?? '#4f46e5' }};
font-size: 10px;
">


                        {{ $certificate->course->title }}


                    </p>








                    {{-- DESCRIPTION TEXT --}}

                    @if($certificate->description)

                    <p class="
mt-1
max-w-3xl
text-slate-600
" style="font-size: 6px;font-style:italic;">

                        {{ $certificate->description }}

                    </p>


                    @endif





                </div>







                {{-- SIGNATURE --}}

                @if($certificate->signature)

                <div class="
absolute
bottom-[16%]
left-[15%]
z-50
text-center
">


                    <img

                        src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'signature'
        ]) }}"

                        class="
w-10 h-10
object-contain
mx-auto
">




                </div>


                @endif



                <div class="absolute bottom-7 left-8 z-10 text-slate-600" style="font-size: 4px;">
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



                {{-- SEAL --}}

                @if($certificate->frame->seal)

                <img

                    src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'seal'
        ]) }}"
                    class="
absolute
bottom-[8%]
right-[40%]
w-15 h-10
object-contain
z-50
"

                    alt="Seal">


                @endif





                {{-- QR CODE --}}

                @if($certificate->qr_code)

                <div class="
absolute
bottom-[13%]
right-8
z-50
">


                    <img

                        src="{{ route('instructor.certificate.file', [
            'certificate' => $certificate->id,
            'type' => 'qr'
        ]) }}"
                        class="
w-6 h-6
h-auto
"


                        alt="QR Code">


                </div>

                @endif






            </div>



        </div>


    </section>


    @endif
    {{-- ================= CERTIFICATE INFORMATION + AUTHENTICITY ================= --}}

    @if($certificate)

    <section class="py-16 bg-white">


        <div class="max-w-6xl mx-auto px-6">


            <div class="grid lg:grid-cols-3 gap-8">





                {{-- ================= CERTIFICATE INFORMATION ================= --}}

                <div class="
lg:col-span-2
bg-white
rounded-3xl
border
border-slate-200
shadow-xl
p-8
">


                    <div class="flex items-center gap-3 mb-8">


                        <div class="
w-12
h-12
rounded-2xl
bg-indigo-100
text-indigo-600
flex
items-center
justify-center
text-xl
font-bold
">

                            ✓

                        </div>


                        <div>

                            <h2 class="text-2xl font-black">

                                Certificate Information

                            </h2>


                            <p class="text-slate-500 text-sm">

                                Official certificate record

                            </p>


                        </div>


                    </div>





                    <div class="grid md:grid-cols-2 gap-5">





                        {{-- CERTIFICATE ID --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Certificate ID

                            </p>


                            <p class="
mt-2
font-mono
font-bold
text-lg
break-all
">

                                {{ $certificate->certificate_id }}

                            </p>


                        </div>







                        {{-- ISSUE DATE --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Issued Date

                            </p>


                            <p class="
mt-2
font-bold
text-lg
">

                                {{ $certificate->created_at->format('d F Y') }}

                            </p>


                        </div>







                        {{-- COURSE --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Course Name

                            </p>


                            <p class="
mt-2
font-bold
">

                                {{ $certificate->course->title }}

                            </p>


                        </div>







                        {{-- CATEGORY --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Category

                            </p>


                            <p class="
mt-2
font-bold
">

                                {{ $certificate->course->category }}

                            </p>


                        </div>







                        {{-- LEARNER --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Certificate Holder

                            </p>


                            <p class="
mt-2
font-bold
">

                                {{ $certificate->user->name }}

                            </p>


                        </div>








                        {{-- INSTRUCTOR --}}

                        <div class="
rounded-2xl
bg-slate-50
p-5
">


                            <p class="text-xs text-slate-500 uppercase">

                                Instructor

                            </p>


                            <p class="
mt-2
font-bold
">

                                {{ $certificate->instructor->name }}

                            </p>


                        </div>



                    </div>



                </div>









                {{-- ================= AUTHENTICITY CARD ================= --}}

                <div class="
bg-gradient-to-br
from-indigo-600
to-purple-700
rounded-3xl
shadow-xl
p-8
text-white
relative
overflow-hidden
">





                    <div class="
absolute
w-48
h-48
bg-white/10
rounded-full
-top-20
-right-20
">
                    </div>





                    <div class="relative z-10">



                        <div class="
w-14
h-14
rounded-2xl
bg-white/20
flex
items-center
justify-center
text-2xl
mb-6
">

                            🔒

                        </div>




                        <h2 class="
text-2xl
font-black
">

                            Authenticity Verified

                        </h2>




                        <p class="
mt-4
text-white/80
leading-relaxed
">


                            This certificate is digitally verified and
                            was officially issued by our learning platform.


                        </p>






                        <div class="
mt-8
space-y-4
">





                            <div class="
bg-white/10
rounded-xl
p-4
">


                                <p class="text-xs text-white/60">

                                    Verification Status

                                </p>


                                <p class="
font-bold
mt-1
">

                                    Verified ✓

                                </p>


                            </div>








                            <div class="
bg-white/10
rounded-xl
p-4
">


                                <p class="text-xs text-white/60">

                                    Verification ID

                                </p>


                                <p class="
font-mono
font-bold
mt-1
break-all
">

                                    {{ request()->segment(2) }}
                                </p>


                            </div>








                            <div class="
bg-white/10
rounded-xl
p-4
">


                                <p class="text-xs text-white/60">

                                    Issued By

                                </p>


                                <p class="
font-bold
mt-1
">

                                    {{ config('app.name') }}

                                </p>


                            </div>






                        </div>






                    </div>


                </div>






            </div>






            {{-- ================= TRUST MESSAGE ================= --}}


            <div class="
mt-12
rounded-3xl
bg-slate-50
border
border-slate-200
p-8
text-center
">


                <h3 class="
text-2xl
font-black
">

                    Why this certificate is trusted?

                </h3>



                <p class="
mt-4
max-w-3xl
mx-auto
text-slate-600
leading-relaxed
">


                    Every certificate contains a unique verification code.
                    Anyone can verify the authenticity of this certificate
                    through our official verification system.


                </p>




                <div class="
mt-6
flex
flex-wrap
justify-center
gap-4
">


                    <div class="
px-5
py-3
rounded-full
bg-green-100
text-green-700
font-semibold
">

                        ✓ Official Record

                    </div>
                    <div class="
px-5
py-3
rounded-full
bg-blue-100
text-blue-700
font-semibold
">

                        ✓ Secure Verification

                    </div>




                    <div class="
px-5
py-3
rounded-full
bg-purple-100
text-purple-700
font-semibold
">

                        ✓ Digital Certificate

                    </div>



                </div>


            </div>



        </div>


    </section>


    @endif
    <!-- {{-- ================= ACTION BUTTONS ================= --}}

    @if($certificate)

    <section class="py-12 bg-slate-100">


        <div class="max-w-5xl mx-auto px-6">


            <div class="
bg-white
rounded-3xl
shadow-xl
border
border-slate-200
p-8
text-center
">



                <h2 class="
text-2xl
font-black
">

                    Certificate Actions

                </h2>



                <p class="
mt-3
text-slate-500
">

                    Save, print or download this verified certificate.

                </p>





                <div class="
mt-8
flex
flex-col
sm:flex-row
justify-center
gap-4
">






                    {{-- PRINT BUTTON --}}

                    <button

                        onclick="window.print()"

                        class="
inline-flex
items-center
justify-center
gap-3
px-8
py-4
rounded-2xl
bg-indigo-600
hover:bg-indigo-700
text-white
font-bold
shadow-lg
transition
">


                        <span class="text-xl">

                            🖨

                        </span>


                        Print Certificate


                    </button>


                </div>



            </div>


        </div>


    </section>


    @endif




 -->


    {{-- ================= FOOTER ================= --}}


    <footer class="
bg-slate-900
text-white
py-12
">


        <div class="
max-w-6xl
mx-auto
px-6
">



            <div class="
grid
md:grid-cols-3
gap-8
">





                {{-- BRAND --}}

                <div>


                    <h3 class="
text-2xl
font-black
">

                        {{ config('app.name') }}

                    </h3>


                    <p class="
mt-3
text-slate-400
leading-relaxed
">


                        Providing trusted digital learning
                        and verified achievement certificates.


                    </p>


                </div>







                {{-- VERIFICATION INFO --}}

                <div>


                    <h4 class="
font-bold
text-lg
">

                        Verification

                    </h4>



                    <ul class="
mt-4
space-y-3
text-slate-400
text-sm
">


                        <li>

                            ✓ Secure Certificate System

                        </li>


                        <li>

                            ✓ Digital Verification

                        </li>


                        <li>

                            ✓ Official Learning Record

                        </li>


                    </ul>


                </div>








                {{-- CONTACT --}}

                <div>


                    <h4 class="
font-bold
text-lg
">

                        Certificate Support

                    </h4>



                    <p class="
mt-4
text-slate-400
text-sm
">

                        If you have questions about this certificate,
                        please contact the issuing organization.


                    </p>


                </div>





            </div>








            <div class="
mt-10
pt-6
border-t
border-white/10
text-center
text-sm
text-slate-500
">


                © {{ date('Y') }}

                {{ config('app.name') }}.

                All rights reserved.


            </div>



        </div>


    </footer>






    {{-- ================= PRINT CSS ================= --}}


    <style>
        @media print {


            body {

                background: white !important;

            }


            /* Hide buttons and footer */

            section:last-of-type,
            footer {

                display: none !important;

            }


            /* Certificate preview */

            .relative.aspect-\[1\.414\/1\] {

                box-shadow: none !important;

                width: 100% !important;

            }



        }
    </style>






</body>

</html>