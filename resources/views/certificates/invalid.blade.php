<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Certificate Verification
    </title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-red-50 to-rose-100 flex items-center justify-center px-6 py-16">

        <div class="max-w-2xl w-full">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-red-100">

                <!-- Header -->

                <div class="bg-gradient-to-r from-red-600 via-rose-600 to-pink-600 px-8 py-10 text-center">

                    <div class="mx-auto flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-14 h-14 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                        </svg>

                    </div>

                    <h1 class="mt-6 text-4xl font-extrabold text-white">
                        Certificate Not Verified
                    </h1>

                    <p class="mt-3 text-red-100 text-lg">
                        This certificate could not be authenticated.
                    </p>

                </div>

                <!-- Body -->

                <div class="px-10 py-10">

                    <div class="rounded-2xl border border-red-200 bg-red-50 p-6">

                        <h2 class="text-xl font-bold text-red-700">
                            Verification Failed
                        </h2>

                        <p class="mt-4 text-slate-700 leading-8">

                            The QR Code or verification link you used does not
                            match any valid certificate in our system.

                        </p>

                        <p class="mt-5 text-slate-700 leading-8">

                            This may happen because the certificate has been
                            modified, the verification link is incorrect,
                            or the certificate was never issued by our platform.

                        </p>

                    </div>

                    <!-- Warning -->

                    <div class="mt-8 rounded-2xl bg-amber-50 border border-amber-200 p-6">

                        <h3 class="font-bold text-amber-700 text-lg">
                            Please Note
                        </h3>

                        <ul class="mt-4 space-y-3 text-slate-700">

                            <li>
                                • Verify that you scanned the complete QR Code.
                            </li>

                            <li>
                                • Ensure the verification URL is correct.
                            </li>

                            <li>
                                • Contact the course instructor if you believe this is an error.
                            </li>

                            <li>
                                • Certificates issued by our platform always have a valid verification record.
                            </li>

                        </ul>

                    </div>

                    <!-- Status -->

                    <div class="mt-8 flex justify-center">

                        <span class="px-6 py-3 rounded-full bg-red-600 text-white font-bold tracking-wide shadow-lg">

                            INVALID CERTIFICATE

                        </span>

                    </div>

                    <!-- Buttons -->

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">

                        <a href="{{ url('/') }}"
                            class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">

                            Go Home

                        </a> <button
                            onclick="history.back()"
                            class="px-8 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 font-semibold transition">

                            Go Back

                        </button>

                    </div>

                </div>

                <!-- Footer -->

                <div class="border-t bg-slate-50 px-8 py-6 text-center">

                    <p class="text-sm text-slate-500">

                        Certificate Verification System • 2026 Secure Digital Verification

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>