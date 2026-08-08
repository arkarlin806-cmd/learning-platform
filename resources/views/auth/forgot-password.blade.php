<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>



<body class="flex items-center justify-center px-4 my-30">

    <!-- Background Effect -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-80 h-80  bg-blue-500/50 rounded-full blur-3xl -top-20 -left-20 animate-pulse"> </div>
        <div class="absolute w-80 h-80  bg-purple-500/50 rounded-full blur-3xl bottom-0 right-0 animate-pulse"> </div>
    </div>

    <!-- Main Card -->
    <div class="relative z-10 w-full max-w-md bg-purple-500 rounded-3xl">


        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-8">

            <!-- Header -->
            <div class="text-center">
                <div class="
            w-20 h-20 mx-auto
            rounded-3xl
            bg-gradient-to-r
            from-blue-500
            to-purple-600
            flex items-center
            justify-center
            shadow-xl">


                    <svg class="w-10 h-10 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">


                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 11c0-1.657 1.343-3 3-3s3 1.343 3 3v2h1a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2h1v-2a6 6 0 0112 0v2" />


                    </svg>


                </div>


                <h2 class="
            text-3xl
            font-bold
            text-white
            mt-5">

                    Forgot Password

                </h2>


                <p class="
            text-gray-300
            mt-2
            text-sm">

                    Verify your email to reset password

                </p>


            </div>




            <!-- Email Form -->


            <form id="emailForm"
                class="mt-8">


                @csrf


                <label class="
            text-gray-200
            text-sm">

                    Email Address

                </label>


                <input

                    type="email"

                    name="email"

                    class="
            mt-2
            w-full
            rounded-2xl
            bg-white/10
            border border-white/20
            text-white
            px-5 py-4
            outline-none
            focus:ring-4
            focus:ring-blue-500/30
            focus:border-blue-400
            transition"

                    placeholder="Enter your Gmail">




                <button
                    id="sendOtpBtn"
                    type="submit"
                    class="
mt-6
w-full
py-4
rounded-2xl
bg-gradient-to-r
from-blue-600
to-purple-600
text-white
font-bold
flex
items-center
justify-center
gap-3
hover:scale-105
transition
">

                    <span id="sendOtpText">
                        Send OTP
                    </span>


                    <svg id="sendOtpLoader"
                        class="hidden animate-spin w-5 h-5 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24">

                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4">
                        </circle>


                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a12 12 0 00-12 12h4z">
                        </path>

                    </svg>

                </button>



            </form>


        </div>


    </div>






    <!-- OTP MODAL -->
    <div id="otpModal"

        class="
fixed inset-0
hidden
items-center
justify-center
bg-black/70
backdrop-blur-sm
z-50
px-4">


        <div class="
w-full
max-w-md
bg-slate-900
border border-white/10
rounded-3xl
p-8
shadow-2xl">


            <div class="text-center">


                <div class="
w-16 h-16
mx-auto
rounded-full
bg-blue-600
flex
items-center
justify-center">


                    <span class="text-white text-2xl">

                        ✉

                    </span>


                </div>


                <h3 class="
text-2xl
font-bold
text-white
mt-5">

                    Verify OTP

                </h3>



                <p class="
text-gray-400
mt-2">

                    Enter 6 digit code

                </p>


            </div>





            <form id="otpForm"
                class="mt-6">


                @csrf


                <input

                    id="otp"

                    name="otp"

                    maxlength="6" class="
w-full
text-center
tracking-[12px]
text-3xl
font-bold
rounded-2xl
bg-white/10
border border-white/20
text-white
py-4
outline-none
focus:ring-4
focus:ring-blue-500/30"

                    placeholder="000000">





                <div id="timer"

                    class="
text-center
text-red-400
font-bold
mt-5">

                    05:00

                </div>





                <button

                    class="
mt-5
w-full
py-4
rounded-2xl
bg-green-600
text-white
font-bold">

                    Verify OTP

                </button>




                <button

                    type="button"

                    id="resendBtn"

                    disabled

                    class="
mt-3
w-full
py-4
rounded-2xl
bg-gray-700
text-gray-400
font-bold">

                    Resend OTP

                </button>



            </form>


        </div>


    </div>







    <!-- RESET PASSWORD MODAL -->


    <div id="resetModal"

        class="
fixed inset-0
hidden
items-center
justify-center
bg-black/70
backdrop-blur-sm
z-50
px-4">


        <div class="
w-full
max-w-md
bg-slate-900
rounded-3xl
p-8">


            <h3 class="
text-2xl
text-white
font-bold
text-center">

                New Password

            </h3>



            <form id="resetForm"
                class="mt-6">

                @csrf


                <input
                    type="password"
                    name="password"
                    placeholder="New Password"
                    class="
w-full mb-4
rounded-xl
bg-white/10
text-white
px-4 py-3">



                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    class="
w-full
rounded-xl
bg-white/10
text-white
px-4 py-3">



                <button

                    class="
mt-5
w-full
py-4
rounded-xl
bg-blue-600
text-white
font-bold">

                    Reset Password

                </button>



            </form>


        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        const csrf = document
            .querySelector('meta[name="csrf-token"]')
            .content;



        let expireAt = 0;

        let timer;



        const emailForm = document.getElementById('emailForm');

        const otpForm = document.getElementById('otpForm');

        const resetForm = document.getElementById('resetForm');


        const otpModal = document.getElementById('otpModal');

        const resetModal = document.getElementById('resetModal');


        const resendBtn = document.getElementById('resendBtn');

        const timerText = document.getElementById('timer');



        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const sendOtpText = document.getElementById('sendOtpText');
        const sendOtpLoader = document.getElementById('sendOtpLoader');

        /*
        |--------------------------------------------------------------------------
        | SEND OTP
        |--------------------------------------------------------------------------
        */


        emailForm.addEventListener('submit', function(e) {


            e.preventDefault();


            // Loading Start

            sendOtpBtn.disabled = true;

            sendOtpText.innerHTML = "Sending OTP...";

            sendOtpLoader.classList.remove('hidden');



            fetch("{{route('forgot.sendOtp')}}", {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN': csrf,

                        'Accept': 'application/json'

                    },

                    body: new FormData(emailForm)


                })

                .then(async res => {

                    let data = await res.json();

                    if (!res.ok)
                        throw data;

                    return data;

                })


                .then(data => {


                    Swal.fire({

                        icon: 'success',
                        title: 'OTP Sent',
                        text: data.message

                    });


                    otpModal.classList.remove('hidden');

                    otpModal.classList.add('flex');


                    expireAt = data.expires_at;

                    startTimer();


                })


                .catch(err => {


                    Swal.fire({

                        icon: 'error',
                        title: 'Failed',
                        text: err.message

                    });


                })

        });


        /*
        |--------------------------------------------------------------------------
        | COUNTDOWN
        |--------------------------------------------------------------------------
        */

        function startTimer() {


            clearInterval(timer);



            timer = setInterval(() => {


                let now = Math.floor(
                    Date.now() / 1000
                );



                let remaining = expireAt - now;



                if (remaining <= 0) {


                    clearInterval(timer);


                    timerText.innerHTML = "00:00";



                    resendBtn.disabled = false;



                    resendBtn.classList.remove(
                        'bg-gray-700'
                    );


                    resendBtn.classList.add(
                        'bg-blue-600',
                        'text-white'
                    );



                    return;


                }



                let min = Math.floor(
                    remaining / 60
                );


                let sec = remaining % 60;



                timerText.innerHTML =

                    String(min).padStart(2, '0') +
                    ":" +
                    String(sec).padStart(2, '0');



            }, 1000);


        }








        /*
        |--------------------------------------------------------------------------
        | VERIFY OTP
        |--------------------------------------------------------------------------
        */


        otpForm.addEventListener(
            'submit',
            function(e) {


                e.preventDefault();



                fetch(
                        "{{route('forgot.verifyOtp')}}", {

                            method: 'POST',

                            headers: {

                                'X-CSRF-TOKEN': csrf,

                                'Accept': 'application/json'

                            },


                            body: new FormData(otpForm)


                        }

                    )


                    .then(async res => {


                        let data = await res.json();


                        if (!res.ok)

                            throw data;


                        return data;


                    })


                    .then(data => {


                        Swal.fire({

                            icon: 'success',

                            title: 'Verified',

                            text: data.message

                        });



                        otpModal.classList.add('hidden');

                        otpModal.classList.remove('flex');



                        resetModal.classList.remove('hidden');

                        resetModal.classList.add('flex');



                    })


                    .catch(err => {


                        Swal.fire({

                            icon: 'error',

                            title: 'Invalid OTP',

                            text: err.message

                        });


                    });



            });









        /*
        |--------------------------------------------------------------------------
        | RESEND OTP
        |--------------------------------------------------------------------------
        */


        resendBtn.addEventListener(
            'click',
            function() {


                resendBtn.disabled = true;



                fetch(
                        "{{route('forgot.resendOtp')}}", {


                            method: 'POST',


                            headers: {


                                'X-CSRF-TOKEN': csrf,

                                'Accept': 'application/json'


                            }


                        }

                    )


                    .then(async res => {


                        let data = await res.json();


                        if (!res.ok)

                            throw data;



                        return data;



                    })


                    .then(data => {


                        Swal.fire({

                            icon: 'success',

                            title: 'OTP Resent',

                            text: data.message

                        });



                        expireAt = data.expires_at;


                        startTimer();


                    })



                    .catch(err => {


                        resendBtn.disabled = false;


                        Swal.fire({

                            icon: 'error',

                            title: 'Failed',

                            text: err.message

                        });


                    });



            });









        /*
        |--------------------------------------------------------------------------
        | RESET PASSWORD
        |--------------------------------------------------------------------------
        */


        resetForm.addEventListener(
            'submit',
            function(e) {


                e.preventDefault();



                fetch(
                        "{{route('forgot.resetPassword')}}", {


                            method: 'POST',


                            headers: {
                                'X-CSRF-TOKEN': csrf,

                                'Accept': 'application/json'


                            },


                            body: new FormData(resetForm)


                        }

                    )


                    .then(async res => {


                        let data = await res.json();


                        if (!res.ok)

                            throw data;



                        return data;


                    })


                    .then(data => {


                        Swal.fire({

                                icon: 'success',

                                title: 'Password Reset',

                                text: data.message

                            })


                            .then(() => {


                                window.location.href = "/learning_platform/public/login";


                            });



                    })


                    .catch(err => {


                        Swal.fire({

                            icon: 'error',

                            title: 'Failed',

                            text: err.message

                        });


                    });



            });
    </script>

</body>

</html>