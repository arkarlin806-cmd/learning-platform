<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }


        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: 'Times New Roman', Times, serif;
        }


        .certificate {

            position: relative;

            width: 1120px;

            height: 790px;

            overflow: hidden;

            page-break-after: avoid;

            page-break-inside: avoid;

        }




        /* =========================
   BACKGROUND IMAGE
========================= */

        .background {

            position: absolute;

            top: 8px;

            left: 8px;

            width: 1104px;

            height: 774px;

            z-index: 1;

        }


        .background img {

            width: 1104px;

            height: 774px;

            display: block;

        }



        /* Border */

        .border {

            position: absolute;

            top: -35;

            left: -30;

            width: 1200px;

            height: 880px;

            z-index: 999;

        }


        .border img {

            width: 1200px;

            height: 880px;

            display: block;

        }


        /* =========================
   WATERMARK
========================= */

        .watermark {

            position: absolute;

            top: 18%;

            left: 25%;

            width: 50%;

            opacity: .08;

            z-index: 5;

        }



        /* =========================
   SAFE AREA
========================= */

        .safe {

            position: absolute;

            top: 55px;

            left: 55px;

            right: 55px;

            bottom: 55px;

            z-index: 50;

        }



        /* LOGO */

        .logo {

            position: absolute;

            top: 5;

            left: 5;

            width: 110px;

        }



        /* =========================
   CONTENT
========================= */


        .content {

            margin-top: 60px;

            text-align: center;

        }



        .title {

            font-size: 42px;

            font-weight: bold;

        }


        .platform {

            margin-top: 16px;

            font-size: 22px;

        }


        .name {

            margin-top: 40px;

            font-size: 48px;

            color: #4338ca;

            font-weight: bold;

        }


        .completed {

            margin-top: 20px;

            font-size: 20px;

        }


        .course {

            margin-top: 18px;

            font-size: 30px;

            font-weight: bold;

        }


        .description {

            margin-top: 15px;

            font-size: 18px;

            font-style: italic;

        }



        /* =========================
 SIGNATURE
========================= */

        .signature {

            position: absolute;

            left: 110px;

            bottom: 200px;

            width: 150px;

        }



        /* SEAL */

        .seal {

            position: absolute;

            left: 50%;

            transform: translateX(-50%);

            bottom: 120px;

            width: 140px;

        }



        /* QR */

        .qr {

            position: absolute;

            right: 40px;

            bottom: 130px;

            width: 90px;

        }



        /* INFO */

        .info {

            position: absolute;

            left: 30px;

            bottom: 130px;

            font-size: 14px;

            line-height: 22px;

        }



        /* =========================
   BORDER
========================= */

        /* 
        .border {

            position: absolute;

            top: 0;

            left: 0;

            width: 1122px;

            height: 794px;

            z-index: 999;

        }



        .border img {

            width: 1122px;

            height: 794px;

            object-fit: fill;

        } */
        @media print {
            .certificate {
                page-break-after: avoid !important;
                page-break-before: avoid !important;
            }
        }
    </style>


</head>


<body>


    <div class="certificate">



        {{-- Background --}}

        @if($certificate->frame->background)

        <div class="background">

            <img src="{{ public_path('storage/'.$certificate->frame->background) }}">

        </div>

        @endif




        {{-- Watermark --}}

        @if($certificate->frame->watermark)

        <img class="watermark"
            src="{{ public_path('storage/'.$certificate->frame->watermark) }}">

        @endif





        <div class="safe">



            {{-- Logo --}}

            @if($certificate->frame->logo)

            <img class="logo"
                src="{{ public_path('storage/'.$certificate->frame->logo) }}">

            @endif





            <div class="content">


                <div class="title" style="color:{{ $certificate->frame->primary_color }}">

                    CERTIFICATE OF COMPLETION

                </div>


                <div class="platform">

                    AI POWER LEARNING PLATFORM

                </div>


                <div class="name" style="color:{{ $certificate->frame->secondary_color }}">

                    {{ $certificate->user->name }}

                </div>


                <div class="completed">

                    has successfully completed

                </div>


                <div class="course" style="color:{{ $certificate->frame->accent_color }}">

                    {{ $certificate->course->title }}

                </div>


                <div class="description">

                    {{ $certificate->description }}

                </div>


            </div>





            {{-- Signature --}}

            @if($certificate->signature)

            <img class="signature"
                src="{{ public_path('storage/'.$certificate->signature) }}">

            @endif





            {{-- Seal --}}

            @if($certificate->frame->seal)

            <img class="seal"
                src="{{ public_path('storage/'.$certificate->frame->seal) }}">

            @endif





            {{-- QR --}}

            @if($certificate->qr_code)

            <img class="qr"
                src="{{ public_path('storage/'.$certificate->qr_code) }}">

            @endif





            <div class="info">


                <strong>Instructor :</strong>

                {{ $certificate->instructor->name }}

                <br>


                <strong>Certificate ID :</strong>
                {{ $certificate->certificate_id }}

                <br>


                <strong>Issued :</strong>

                {{ $certificate->issued_at->format('d M Y') }}


            </div>



        </div>






        {{-- Border Last --}}

        @if($certificate->frame->border_image)

        <div class="border">

            <img src="{{ public_path('storage/'.$certificate->frame->border_image) }}">

        </div>

        @endif



    </div>


</body>

</html>