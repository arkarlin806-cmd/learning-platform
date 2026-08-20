@extends('layout.admin')

@section('page_title','Certificate')
@section('page','Admin show and analysis learner certificate.')
@section('content')

<div class="min-h-screen px-4 sm:px-6 lg:px-8 py-8">

    <div class="max-w-[1500px] mx-auto">
        <div class="relative overflow-hidden rounded-[30px] bg-slate-950 text-white p-7 sm:p-9 mb-7 shadow-xl">

            <!-- grow   -->
            <div class="absolute -top-32 -right-20 w-96 h-96 rounded-full bg-indigo-600/3 blur-3xl">
            </div>

            <div class="absolute -bottom-40 left-20 w-96 h-96 rounded-full bg-fuchsia-600/20 blur-3xl">
            </div>

            <div class="absolute top-10 right-[30%] w-40 h-40 rounded-full bg-cyan-500/10 blur-3xl">
            </div>
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <div>
                        {{-- Badge --}}
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md mb-4">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse">
                            </span>

                            <span class="text-xs font-semibold text-slate-200">
                                CERTIFICATE MANAGEMENT
                            </span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight">
                            Course Completion
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">
                                & Certificates
                            </span>
                        </h1>
                        <p class="text-slate-400 mt-3 max-w-2xl text-sm sm:text-base leading-relaxed">
                            Monitor completed learners and manage
                            certificate issuance from one place.
                        </p>
                    </div>


                    {{-- Graduation Icon --}}

                    <div class="hidden sm:flex shrink-0 w-24 h-24 rounded-[28px] bg-white/10 border border-white/10 backdrop-blur-xl
                                items-center justify-center text-5xl shadow-2xl rotate-3 hover:rotate-0 transition duration-500">
                        🎓
                    </div>
                </div>
            </div>
        </div>

        <!-- staticts -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

            {{-- COMPLETED --}}
            <div class="stat-card bg-white rounded-[24px] border border-slate-200 p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Completed Learners
                        </p>
                        <h2 class="text-3xl font-black text-slate-900 mt-2">
                            {{ number_format($totalCompleted) }}
                        </h2>

                        <p class="text-xs text-slate-400 mt-2">
                            Course completed & paid
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                        ✓
                    </div>
                </div>
            </div>

            {{-- ISSUED --}}
            <div class="stat-card bg-white rounded-[24px] border border-slate-200 p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Certificates Issued
                        </p>

                        <h2 class="text-3xl font-black text-emerald-600 mt-2">
                            {{ number_format($certificateIssued) }}
                        </h2>

                        <p class="text-xs text-emerald-500 mt-2">
                            Successfully issued
                        </p>
                    </div>


                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                        🎓
                    </div>
                </div>
            </div>
            {{-- PENDING --}}

            <div class="stat-card bg-white rounded-[24px] border border-slate-200 p-6 shadow-sm">
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Not Issued
                        </p>
                        <h2 class="text-3xl font-black text-amber-500 mt-2">
                            {{ number_format($certificatePending) }}
                        </h2>

                        <p class="text-xs text-amber-500 mt-2">
                            Waiting for certificate
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        ⏳
                    </div>
                </div>
            </div>

            {{-- RATE --}}
            <div class="stat-card bg-white rounded-[24px] border border-slate-200 p-6 shadow-sm">

                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Certificate Rate
                        </p>
                        <h2 class="text-3xl font-black text-violet-600 mt-2">
                            {{ $certificateRate }}%
                        </h2>
                        <p class="text-xs text-violet-500 mt-2">
                            Completion → Certificate
                        </p>
                    </div>
                    <div class="w-12 h-12
                                rounded-2xl
                                bg-violet-50
                                text-violet-600
                                flex items-center
                                justify-center
                                text-xl">

                        %

                    </div>

                </div>

            </div>

        </div>



        <!-- filter area  -->

        <div class="bg-white
                    rounded-[26px]
                    border border-slate-200
                    shadow-sm
                    p-5 sm:p-6
                    mb-6">

            <div class="flex flex-col
                        lg:flex-row
                        lg:items-center
                        lg:justify-between
                        gap-4 mb-5">

                <div>

                    <h2 class="text-lg
                               font-bold
                               text-slate-900">

                        Learner Directory

                    </h2>

                    <p class="text-sm
                              text-slate-500
                              mt-1">

                        Filter completed learners by course,
                        category or certificate status.

                    </p>

                </div>


                <div class="flex items-center gap-2">

                    <span class="w-2 h-2
                                 rounded-full
                                 bg-emerald-500">
                    </span>

                    <span class="text-xs
                                 font-semibold
                                 text-slate-500">

                        {{ $learners->total() }} records

                    </span>

                </div>

            </div>



            {{-- FILTER FORM --}}

            <form
                method="GET"
                action="{{ route('admin.certificates.learners') }}"
                class="grid grid-cols-1
                       md:grid-cols-2
                       xl:grid-cols-5
                       gap-4">


                {{-- SEARCH --}}

                <div class="xl:col-span-2">

                    <label class="block
                                  text-xs
                                  font-bold
                                  text-slate-500
                                  mb-2">

                        Search

                    </label>

                    <div class="relative">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search learner or course..."
                            class="w-full
                                   h-12
                                   pl-11
                                   pr-4
                                   rounded-2xl
                                   border border-slate-200
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   transition
                                   focus:bg-white
                                   focus:border-indigo-500
                                   focus:ring-4
                                   focus:ring-indigo-100">

                        <div class="absolute
                                    left-4
                                    top-1/2
                                    -translate-y-1/2
                                    text-slate-400">

                            🔍

                        </div>

                    </div>

                </div>



                {{-- CATEGORY --}}

                <div>

                    <label class="block
                                  text-xs
                                  font-bold
                                  text-slate-500
                                  mb-2">

                        Category

                    </label>

                    <select
                        name="category"
                        onchange="this.form.submit()"
                        class="w-full
                               h-12
                               px-4
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               text-sm
                               text-slate-700
                               outline-none
                               focus:bg-white
                               focus:border-indigo-500
                               focus:ring-4
                               focus:ring-indigo-100">

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $item)

                        <option
                            value="{{ $item }}"
                            {{ $category == $item
                                    ? 'selected'
                                    : '' }}>

                            {{ $item }}

                        </option>

                        @endforeach

                    </select>

                </div>



                {{-- COURSE --}}

                <div>

                    <label class="block
                                  text-xs
                                  font-bold
                                  text-slate-500
                                  mb-2">

                        Course

                    </label>

                    <select
                        name="course_id"
                        onchange="this.form.submit()"
                        class="w-full
                               h-12
                               px-4
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               text-sm
                               text-slate-700
                               outline-none
                               focus:bg-white
                               focus:border-indigo-500
                               focus:ring-4
                               focus:ring-indigo-100">

                        <option value="">
                            All Courses
                        </option>

                        @foreach($courses as $course)

                        <option
                            value="{{ $course->id }}"
                            {{ $courseId == $course->id
                                    ? 'selected'
                                    : '' }}>

                            {{ $course->title }}

                        </option>

                        @endforeach

                    </select>

                </div>



                {{-- CERTIFICATE STATUS --}}

                <div>

                    <label class="block
                                  text-xs
                                  font-bold
                                  text-slate-500
                                  mb-2">

                        Certificate Status

                    </label>

                    <select
                        name="certificate_status"
                        onchange="this.form.submit()"
                        class="w-full
                               h-12
                               px-4
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               text-sm
                               text-slate-700
                               outline-none
                               focus:bg-white
                               focus:border-indigo-500
                               focus:ring-4
                               focus:ring-indigo-100">

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="issued"
                            {{ $certificateStatus === 'issued'
                                ? 'selected'
                                : '' }}>

                            ✓ Certificate Issued

                        </option>

                        <option
                            value="pending"
                            {{ $certificateStatus === 'pending'
                                ? 'selected'
                                : '' }}>

                            ○ Not Issued

                        </option>

                    </select>

                </div>



                {{-- BUTTONS --}}

                <div class="xl:col-span-5
                            flex flex-wrap
                            justify-end
                            gap-3
                            pt-1">

                    <a
                        href="{{ route(
                            'admin.certificates.learners'
                        ) }}"
                        class="inline-flex
                               items-center
                               justify-center
                               h-11
                               px-5
                               rounded-xl
                               border border-slate-200
                               bg-white
                               text-sm
                               font-semibold
                               text-slate-600
                               hover:bg-slate-50
                               transition">

                        Reset

                    </a>


                    <button
                        type="submit"
                        class="inline-flex
                               items-center
                               justify-center
                               h-11
                               px-6
                               rounded-xl
                               bg-slate-950
                               text-white
                               text-sm
                               font-semibold
                               hover:bg-indigo-600
                               transition
                               shadow-lg
                               shadow-slate-900/10">

                        Apply Filters

                    </button>

                </div>

            </form>

        </div>



        <!-- Table  -->

        <div class="bg-white
                    rounded-[26px]
                    border border-slate-200
                    shadow-sm
                    overflow-hidden">


            {{-- TABLE TOP --}}

            <div class="px-5 sm:px-6
                        py-5
                        border-b border-slate-200
                        flex flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-4">

                <div>

                    <h3 class="text-lg
                               font-bold
                               text-slate-900">

                        Completed Learners

                    </h3>

                    <p class="text-xs
                              text-slate-500
                              mt-1">

                        Only paid learners from completed courses
                        are shown.

                    </p>

                </div>


                <div class="inline-flex
                            items-center
                            gap-2
                            px-3 py-2
                            rounded-xl
                            bg-slate-50
                            border border-slate-200">

                    <span class="w-2 h-2
                                 rounded-full
                                 bg-indigo-500">
                    </span>

                    <span class="text-xs
                                 font-bold
                                 text-slate-600">

                        {{ $learners->total() }} learners

                    </span>

                </div>

            </div>



            <!-- Table  -->
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    <thead>

                        <tr class="bg-slate-50/80">

                            <th class="px-6 py-4
                                       text-left
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Learner

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Course

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Category

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Order

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Certificate

                            </th>


                            <th class="px-6 py-4
                                       text-right
                                       text-[11px]
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-slate-400">

                                Action

                            </th>

                        </tr>

                    </thead>



                    <tbody class="divide-y
                                 divide-slate-100">


                        @forelse($learners as $learner)


                        <tr class="group
                                       hover:bg-indigo-50/30
                                       transition-all
                                       duration-200">


                            <!-- learner  -->

                            <td class="px-6 py-5">

                                <div class="flex
                                                items-center
                                                gap-3">

                                    {{-- Avatar --}}

                                    <div class="relative">

                                        <img
                                            src="https://ui-avatars.com/api/?name={{ $learner->name }}"
                                            class="w-12 h-12
                                                       rounded-full
                                                       object-cover
                                                       ring-4
                                                       ring-slate-50
                                                       shadow-sm">


                                        {{-- Online/status dot --}}

                                        <span
                                            class="absolute
                                                       right-0
                                                       bottom-0
                                                       w-3.5 h-3.5
                                                       rounded-full
                                                       bg-emerald-500
                                                       border-2
                                                       border-white">
                                        </span>

                                    </div>


                                    <div class="min-w-0">

                                        <p class="font-bold
                                                      text-slate-900
                                                      truncate">

                                            {{ $learner->name }}

                                        </p>

                                        <p class="text-xs
                                                      text-slate-500
                                                      truncate
                                                      mt-0.5">

                                            {{ $learner->email }}

                                        </p>

                                    </div>

                                </div>

                            </td>
                            <!-- course -->
                            <td class="px-6 py-5">

                                <p class="font-bold text-slate-800 max-w-[240px]">
                                    {{ $learner->course_title }}
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Course completed
                                </p>
                            </td>

                            <!-- category  -->
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex
                                               items-center
                                               px-3 py-1.5
                                               rounded-full
                                               bg-indigo-50
                                               text-indigo-600
                                               text-xs
                                               font-bold">

                                    {{ $learner->category }}

                                </span>

                            </td>

                            <!-- order -->

                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex
                                               items-center
                                               gap-2
                                               px-3 py-1.5
                                               rounded-full
                                               bg-emerald-50
                                               text-emerald-700
                                               text-xs
                                               font-bold">

                                    <span
                                        class="w-2 h-2
                                                   rounded-full
                                                   bg-emerald-500">
                                    </span>

                                    Paid

                                </span>

                            </td>
                            <!-- certificate  -->

                            <td class="px-6 py-5">


                                @if($learner->certificate_id)


                                {{-- ISSUED --}}

                                <div>

                                    <span
                                        class="inline-flex
                                                       items-center
                                                       gap-2
                                                       px-3 py-1.5
                                                       rounded-full
                                                       bg-emerald-50
                                                       text-emerald-700
                                                       text-xs
                                                       font-bold">

                                        <span
                                            class="flex
                                                           items-center
                                                           justify-center
                                                           w-4 h-4
                                                           rounded-full
                                                           bg-emerald-500
                                                           text-white
                                                           text-[9px]">

                                            ✓

                                        </span>

                                        Issued

                                    </span>

                                </div>


                                @else


                                {{-- NOT ISSUED --}}

                                <div>

                                    <span
                                        class="inline-flex
                                                       items-center
                                                       gap-2
                                                       px-3 py-1.5
                                                       rounded-full
                                                       bg-amber-50
                                                       text-amber-700
                                                       text-xs
                                                       font-bold">

                                        <span
                                            class="w-4 h-4
                                                           rounded-full
                                                           bg-amber-400
                                                           flex
                                                           items-center
                                                           justify-center
                                                           text-white
                                                           text-[9px]">

                                            !

                                        </span>

                                        Not Issued

                                    </span>

                                </div>


                                @endif

                            </td>
                            <!-- action -->
                            <td class="px-6 py-5 text-right">


                                @if($learner->certificate_id)


                                {{-- VIEW --}}

                                <a
                                    href="{{ route(
                                                    'instructor.certificates.show',
                                                    $learner->certificate_id
                                                ) }}"
                                    class="inline-flex
                                                   items-center
                                                   gap-2
                                                   px-4 py-2.5
                                                   rounded-xl
                                                   bg-slate-900
                                                   text-white
                                                   text-xs
                                                   font-bold
                                                   hover:bg-indigo-600
                                                   hover:shadow-lg
                                                   hover:shadow-indigo-500/20
                                                   transition-all
                                                   duration-200">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                    </svg>

                                    View

                                </a>


                                @else


                                {{-- ISSUE --}}

                                <a
                                    href="{{ route('instructor.learner.profile', [
                                                'course' => $learner->course_id,
                                                'user'   => $learner->user_id
                                            ]) }}"
                                    class="inline-flex
                                                   items-center
                                                   gap-2
                                                   px-4 py-2.5
                                                   rounded-xl
                                                   bg-indigo-600
                                                   text-white
                                                   text-xs
                                                   font-bold
                                                   hover:bg-indigo-700
                                                   hover:shadow-lg
                                                   hover:shadow-indigo-500/20
                                                   transition-all
                                                   duration-200">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4" />

                                    </svg>

                                    Issue

                                </a>


                                @endif


                            </td>

                        </tr>


                        @empty


                        {{-- EMPTY STATE --}}

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-20 text-center">

                                <div class="max-w-sm
                                                mx-auto">

                                    <div
                                        class="w-20 h-20
                                                   mx-auto
                                                   rounded-3xl
                                                   bg-indigo-50
                                                   flex
                                                   items-center
                                                   justify-center
                                                   text-4xl
                                                   mb-5">

                                        🎓

                                    </div>


                                    <h3
                                        class="text-lg
                                                   font-bold
                                                   text-slate-800">

                                        No learners found

                                    </h3>


                                    <p
                                        class="text-sm
                                                   text-slate-500
                                                   mt-2">

                                        There are no completed
                                        learners matching your
                                        current filters.

                                    </p>


                                    <a
                                        href="{{ route(
                                                'admin.certificates.learners'
                                            ) }}"
                                        class="inline-flex
                                                   mt-5
                                                   px-5 py-2.5
                                                   rounded-xl
                                                   bg-slate-900
                                                   text-white
                                                   text-sm
                                                   font-semibold
                                                   hover:bg-indigo-600
                                                   transition">

                                        Clear Filters

                                    </a>

                                </div>

                            </td>

                        </tr>


                        @endforelse

                    </tbody>

                </table>

            </div>
            <!-- pagination  -->

            @if($learners->hasPages())

            <div class="px-5 sm:px-6
                            py-5
                            border-t border-slate-200">

                {{ $learners->links() }}

            </div>

            @endif


        </div>


    </div>

</div>


<style>
    @keyframes pageEnter {

        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    .stat-card {
        animation: pageEnter .55s ease both;
        transition:
            transform .3s ease,
            box-shadow .3s ease;
    }


    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 20px 40px rgba(15, 23, 42, .08);
    }


    tbody tr {
        animation: pageEnter .4s ease both;
    }


    /* Smooth scrollbar */

    ::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

@endsection