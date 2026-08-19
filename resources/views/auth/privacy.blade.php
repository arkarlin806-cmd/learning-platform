<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    @vite('resources/css/app.css')

</head>

<body>


    <div class="min-h-screen bg-slate-50 text-slate-900">

        {{-- =========================================================
        HERO
    ========================================================== --}}
        <section class="relative overflow-hidden border-b border-slate-200 bg-white">

            {{-- Background decoration --}}
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-32 -right-32 h-96 w-96 rounded-full bg-indigo-100/60 blur-3xl"></div>
                <div class="absolute -bottom-40 -left-32 h-96 w-96 rounded-full bg-cyan-100/50 blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-20 lg:py-24">

                <div class="max-w-4xl">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 rounded-full
                            border border-indigo-200 bg-indigo-50
                            px-4 py-2 text-sm font-medium text-indigo-700">

                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />

                        </svg>

                        Privacy & Data Protection
                    </div>

                    <h1 class="mt-7 text-4xl sm:text-5xl lg:text-6xl
                           font-bold tracking-tight text-slate-950">

                        Your privacy matters to us.

                    </h1>

                    <p class="mt-6 max-w-3xl text-lg sm:text-xl
                          leading-8 text-slate-600">

                        We are committed to protecting your personal information
                        and being transparent about how AI POWER LEARNING PLATFORM
                        collects, uses, stores, and protects your data.

                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4 text-sm">

                        <div class="inline-flex items-center gap-2
                                rounded-lg bg-slate-100 px-4 py-2.5
                                text-slate-600">

                            <svg class="w-4 h-4 text-slate-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                            </svg>

                            Effective: August 19, 2026

                        </div>

                        <div class="inline-flex items-center gap-2
                                rounded-lg bg-slate-100 px-4 py-2.5
                                text-slate-600">

                            <svg class="w-4 h-4 text-slate-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />

                            </svg>

                            Last updated: August 19, 2026

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
        MAIN
    ========================================================== --}}
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 lg:py-16">

            <div class="grid grid-cols-1 lg:grid-cols-[250px_minmax(0,1fr)]
                    gap-10 lg:gap-16">


                {{-- =================================================
                TABLE OF CONTENTS
            ================================================== --}}
                <aside class="hidden lg:block">

                    <div class="sticky top-24">

                        <p class="text-xs font-bold uppercase tracking-widest
                              text-slate-400 mb-4">

                            On this page

                        </p>

                        <nav class="space-y-1 text-sm">

                            <a href="#overview"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Overview

                            </a>

                            <a href="#information"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Information We Collect

                            </a>

                            <a href="#how-we-use"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                How We Use Information

                            </a>

                            <a href="#ai"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                AI & Learning Data

                            </a>

                            <a href="#sharing"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Data Sharing

                            </a>

                            <a href="#security"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Security

                            </a>

                            <a href="#retention"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Data Retention

                            </a>

                            <a href="#rights"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Your Privacy Rights

                            </a>

                            <a href="#cookies"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Cookies

                            </a>

                            <a href="#children"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Children's Privacy

                            </a>

                            <a href="#changes"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Policy Changes

                            </a>

                            <a href="#contact"
                                class="block rounded-lg px-3 py-2
                                  text-slate-600 hover:bg-slate-100
                                  hover:text-indigo-600 transition">

                                Contact Us

                            </a>

                        </nav>

                    </div>

                </aside>


                {{-- =================================================
                CONTENT
            ================================================== --}}
                <main class="max-w-4xl">


                    {{-- OVERVIEW --}}
                    <section id="overview"
                        class="scroll-mt-24 pb-12 border-b border-slate-200">

                        <div class="flex items-start gap-4">

                            <div class="flex-shrink-0 flex items-center
                                    justify-center w-11 h-11 rounded-xl
                                    bg-indigo-50 text-indigo-600">

                                <svg class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955
                                      11.955 0 0112 2.944a11.955 11.955
                                      0 01-8.618 3.04A12.02 12.02
                                      0 003 9c0 5.591 3.824 10.29
                                      9 11.622C17.176 19.29 21
                                      14.591 21 9c0-.979-.118-1.93-.382-2.836z" />

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-2xl sm:text-3xl font-bold
                                       text-slate-950">

                                    Privacy at AI POWER LEARNING PLATFORM

                                </h2>

                                <p class="mt-4 text-slate-600 leading-8">

                                    This Privacy Policy explains how AI POWER
                                    LEARNING PLATFORM ("Platform", "we", "us",
                                    or "our") handles information when you use
                                    our website, learning services, courses,
                                    AI-powered features, and related services.

                                </p>

                                <p class="mt-4 text-slate-600 leading-8">

                                    We believe privacy should be understandable.
                                    This policy therefore explains what we
                                    collect, why we collect it, how we use it,
                                    when we share it, and the choices available
                                    to you.

                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- PRIVACY PRINCIPLES --}}
                    <section class="py-12">

                        <div class="grid sm:grid-cols-2 gap-4">

                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-6 shadow-sm">

                                <div class="w-10 h-10 rounded-xl
                                        bg-emerald-50 text-emerald-600
                                        flex items-center justify-center">

                                    ✓

                                </div>

                                <h3 class="mt-5 font-semibold text-slate-950">
                                    Transparency
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    We explain how your information is used and
                                    why it is needed.
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-6 shadow-sm">

                                <div class="w-10 h-10 rounded-xl
                                        bg-blue-50 text-blue-600
                                        flex items-center justify-center">

                                    🔒

                                </div>

                                <h3 class="mt-5 font-semibold text-slate-950">
                                    Security
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    We use reasonable technical and organizational
                                    safeguards to protect your information.
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-6 shadow-sm">

                                <div class="w-10 h-10 rounded-xl
                                        bg-purple-50 text-purple-600
                                        flex items-center justify-center">

                                    AI

                                </div>

                                <h3 class="mt-5 font-semibold text-slate-950">
                                    Responsible AI
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    AI features are designed to support learning,
                                    not replace your control over your data.
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-6 shadow-sm">

                                <div class="w-10 h-10 rounded-xl
                                        bg-amber-50 text-amber-600
                                        flex items-center justify-center">

                                    ⚙

                                </div>

                                <h3 class="mt-5 font-semibold text-slate-950">
                                    User Control
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    You can manage your account information and
                                    request privacy-related actions.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- INFORMATION --}}
                    <section id="information"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            1. Information We Collect
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">
                            Depending on how you use the Platform, we may collect
                            the following categories of information:
                        </p>


                        <div class="mt-7 space-y-4">

                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                                <h3 class="font-semibold text-slate-900">
                                    Account Information
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Name, email address, profile information,
                                    account credentials, and other information
                                    needed to create and manage your account.
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                                <h3 class="font-semibold text-slate-900">
                                    Learning Information
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Courses you enroll in, lessons viewed,
                                    learning progress, quiz results, certificates,
                                    grades, achievements, XP, streaks, and
                                    learning preferences.
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                                <h3 class="font-semibold text-slate-900">
                                    Content You Provide
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Information and files you upload or submit,
                                    including course materials, lesson files,
                                    questions, messages, feedback, and other
                                    content you choose to provide.
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                                <h3 class="font-semibold text-slate-900">
                                    Technical Information
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Browser type, device information, IP address,
                                    log information, approximate location,
                                    operating system, and information about how
                                    you interact with the Platform.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- HOW WE USE --}}
                    <section id="how-we-use"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            2. How We Use Your Information
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">
                            We use information we collect for purposes such as:
                        </p>

                        <ul class="mt-6 space-y-3">

                            @foreach([
                            'Creating and managing your account',
                            'Providing courses, lessons, assessments, and certificates',
                            'Tracking learning progress and achievements',
                            'Personalizing learning recommendations',
                            'Providing customer support',
                            'Processing payments and transactions',
                            'Improving the performance and reliability of the Platform',
                            'Detecting fraud, abuse, and security threats',
                            'Sending important service and account notifications',
                            'Improving our AI-powered learning features'
                            ] as $item)

                            <li class="flex gap-3 text-slate-600 leading-7">

                                <span class="mt-2 w-1.5 h-1.5 flex-shrink-0
                                             rounded-full bg-indigo-500"></span>

                                <span>{{ $item }}</span>

                            </li>

                            @endforeach

                        </ul>

                    </section>


                    {{-- AI --}}
                    <section id="ai"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <div class="rounded-3xl border border-indigo-200
                                bg-gradient-to-br from-indigo-50
                                via-white to-cyan-50 p-7 sm:p-9">

                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 flex-shrink-0
                                        rounded-2xl bg-indigo-600
                                        text-white flex items-center
                                        justify-center font-bold">

                                    AI

                                </div>

                                <div>

                                    <h2 class="text-2xl sm:text-3xl font-bold
                                           text-slate-950">

                                        3. AI & Learning Data

                                    </h2>

                                    <p class="mt-4 text-slate-600 leading-8">

                                        AI POWER LEARNING PLATFORM uses artificial
                                        intelligence to provide features such as
                                        learning assistance, lesson summaries,
                                        recommendations, and personalized
                                        learning experiences.

                                    </p>

                                </div>

                            </div>


                            <div class="mt-7 grid sm:grid-cols-2 gap-4">

                                <div class="rounded-2xl bg-white/80
                                        border border-white p-5">

                                    <h3 class="font-semibold text-slate-900">
                                        AI Processing
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Information may be processed by AI systems
                                        when necessary to provide an AI-powered
                                        feature you request or use.
                                    </p>

                                </div>


                                <div class="rounded-2xl bg-white/80
                                        border border-white p-5">

                                    <h3 class="font-semibold text-slate-900">
                                        Learning Assistance
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        AI may use relevant course or lesson
                                        context to generate explanations,
                                        summaries, recommendations, or answers.
                                    </p>

                                </div>

                            </div>


                            <div class="mt-6 rounded-2xl border border-indigo-200
                                    bg-white p-5">

                                <p class="text-sm leading-7 text-slate-600">

                                    <strong class="text-slate-900">
                                        Important:
                                    </strong>

                                    AI-generated content may not always be
                                    completely accurate. AI features are provided
                                    as learning assistance and should not be
                                    treated as a substitute for professional,
                                    academic, legal, medical, or financial advice.

                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- SHARING --}}
                    <section id="sharing"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            4. When We Share Information
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            We do not sell your personal information. We may share
                            information only when reasonably necessary to operate
                            the Platform, provide requested services, comply with
                            legal obligations, or protect our users and systems.

                        </p>

                        <div class="mt-7 space-y-3">

                            @foreach([
                            'Service providers that help us operate hosting, storage, email, payment, analytics, or technical services',
                            'AI service providers when required to provide an AI feature you use',
                            'Authorities or other parties when disclosure is required by applicable law',
                            'Other parties when necessary to protect the rights, safety, security, or integrity of the Platform'
                            ] as $item)

                            <div class="flex gap-3 rounded-xl border
                                        border-slate-200 bg-white p-5">

                                <span class="text-indigo-600 font-bold">
                                    →
                                </span>

                                <span class="text-sm leading-6 text-slate-600">
                                    {{ $item }}
                                </span>

                            </div>

                            @endforeach

                        </div>

                    </section>


                    {{-- SECURITY --}}
                    <section id="security"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            5. Security
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            We use reasonable technical and organizational
                            safeguards designed to protect personal information
                            against unauthorized access, alteration, disclosure,
                            loss, or destruction.

                        </p>

                        <div class="mt-7 grid sm:grid-cols-3 gap-4">

                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-5">

                                <div class="text-indigo-600 font-bold text-lg">
                                    SSL
                                </div>

                                <p class="mt-2 text-sm text-slate-600">
                                    Encrypted connections are used where
                                    appropriate.
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-5">

                                <div class="text-indigo-600 font-bold text-lg">
                                    Access
                                </div>

                                <p class="mt-2 text-sm text-slate-600">
                                    Access to information is limited based on
                                    operational requirements.
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200
                                    bg-white p-5">

                                <div class="text-indigo-600 font-bold text-lg">
                                    Monitoring
                                </div>

                                <p class="mt-2 text-sm text-slate-600">
                                    We take steps to identify and respond to
                                    security incidents.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- RETENTION --}}
                    <section id="retention"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            6. Data Retention
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            We retain personal information only for as long as
                            reasonably necessary for the purposes described in
                            this Privacy Policy, including providing services,
                            maintaining records, resolving disputes, enforcing
                            agreements, and complying with legal obligations.

                        </p>

                        <div class="mt-6 rounded-2xl bg-amber-50
                                border border-amber-200 p-6">

                            <p class="text-sm leading-7 text-amber-900">

                                Retention periods may vary depending on the type
                                of information, the purpose for which it was
                                collected, and applicable legal or operational
                                requirements.

                            </p>

                        </div>

                    </section>


                    {{-- RIGHTS --}}
                    <section id="rights"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            7. Your Privacy Rights
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            Depending on where you live and applicable law, you
                            may have rights regarding your personal information.

                        </p>

                        <div class="mt-7 grid sm:grid-cols-2 gap-3">

                            @foreach([
                            'Access your personal information',
                            'Correct inaccurate information',
                            'Request deletion of certain information',
                            'Request restriction of processing',
                            'Object to certain processing',
                            'Request a copy or portability of your information',
                            'Withdraw consent where processing is based on consent',
                            'Lodge a complaint with an appropriate privacy authority'
                            ] as $right)

                            <div class="flex items-center gap-3 rounded-xl
                                        border border-slate-200 bg-white p-4">

                                <span class="flex items-center justify-center
                                             w-7 h-7 rounded-full
                                             bg-indigo-50 text-indigo-600
                                             text-sm font-bold">

                                    ✓

                                </span>

                                <span class="text-sm text-slate-700">
                                    {{ $right }}
                                </span>

                            </div>

                            @endforeach

                        </div>

                    </section>


                    {{-- COOKIES --}}
                    <section id="cookies"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            8. Cookies & Similar Technologies
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            We may use cookies and similar technologies to keep
                            users signed in, remember preferences, understand
                            Platform usage, maintain security, and improve the
                            user experience.

                        </p>

                        <p class="mt-4 text-slate-600 leading-8">

                            Where required by applicable law, we will request
                            appropriate consent before using non-essential
                            cookies or similar technologies.

                        </p>

                    </section>


                    {{-- CHILDREN --}}
                    <section id="children"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            9. Children's Privacy
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            Our services are intended to be used in accordance
                            with applicable age requirements and laws. We do not
                            knowingly collect personal information from children
                            where such collection is prohibited without the
                            required parental or guardian authorization.

                        </p>

                        <p class="mt-4 text-slate-600 leading-8">

                            If you believe a child has provided personal
                            information in circumstances where it should not have
                            been collected, please contact us so we can review
                            and take appropriate action.

                        </p>

                    </section>


                    {{-- POLICY CHANGES --}}
                    <section id="changes"
                        class="scroll-mt-24 py-12 border-t border-slate-200">

                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950">
                            10. Changes to This Privacy Policy
                        </h2>

                        <p class="mt-4 text-slate-600 leading-8">

                            We may update this Privacy Policy from time to time
                            to reflect changes in our services, technology,
                            legal requirements, or privacy practices.

                        </p>

                        <p class="mt-4 text-slate-600 leading-8">

                            When we make significant changes, we may provide
                            additional notice through the Platform or other
                            appropriate communication channels.

                        </p>

                    </section>


                    {{-- CONTACT --}}
                    <section id="contact"
                        class="scroll-mt-24 pt-12 border-t border-slate-200">

                        <div class="rounded-3xl bg-slate-950 p-8 sm:p-10
                                text-white">

                            <div class="max-w-2xl">

                                <div class="inline-flex items-center
                                        rounded-full bg-white/10
                                        px-3 py-1.5 text-xs font-medium
                                        text-slate-200">

                                    Privacy Support

                                </div>

                                <h2 class="mt-5 text-2xl sm:text-3xl font-bold">

                                    Have a privacy question?

                                </h2>

                                <p class="mt-4 text-slate-300 leading-7">

                                    If you have questions about this Privacy
                                    Policy, your personal information, or a
                                    privacy request, please contact our support
                                    team.

                                </p>

                                <div class="mt-7">

                                    <a href="mailto:privacy@yourdomain.com"
                                        class="inline-flex items-center gap-2
                                          rounded-xl bg-white
                                          px-5 py-3 text-sm font-semibold
                                          text-slate-950
                                          hover:bg-slate-100 transition">

                                        privacy@yourdomain.com

                                        <svg class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />

                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- FINAL NOTE --}}
                    <div class="mt-10 text-sm text-slate-500 leading-7">

                        <p>
                            © {{ date('Y') }} AI POWER LEARNING PLATFORM.
                            All rights reserved.
                        </p>

                    </div>


                </main>

            </div>

        </div>

    </div>


</body>

</html>