@extends('layout.course_ins')
@section('title','Live Room')

@section('content')

<div class="max-w-7xl mx-auto py-8">

    <div class="bg-white rounded-xl shadow">

        <div class="p-5 border-b">

            <h2 class="text-2xl font-bold">

                {{ $session->title }}

            </h2>

        </div>

        <div id="jitsi-container"
            class="w-full h-[700px]">

        </div>

    </div>

</div>

<script src="https://8x8.vc/external_api.js"></script>
<script>
    const domain = "meet.jit.si";

    const options = {

        roomName: "{{ $session->room_name }}",

        width: "100%",

        height: 700,

        parentNode: document.querySelector('#jitsi-container'),

        userInfo: {

            displayName: "{{ auth()->user()->name }}"

        }

    };

    new JitsiMeetExternalAPI(domain, options);
</script>

@endsection