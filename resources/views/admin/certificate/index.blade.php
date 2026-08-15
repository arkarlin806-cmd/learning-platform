@extends('layout.admin')
@section('page_title','Certificate')
@section('page','Admin analysis and show certificates.')
@section('content')
<!-- Header -->
<div class="mb-8 flex flex-col md:flex-row justify-between gap-4">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Certificate Frames
        </h1>

        <p class="text-slate-500 mt-2">
            Manage professional certificate templates
        </p>
    </div>


    <a href="{{ route('admin.certificate.frames.create') }}"
        class="inline-flex items-center justify-center gap-2 
           px-6 py-1 rounded-2xl h-12
           bg-gradient-to-r from-blue-600 to-purple-600
           text-white font-semibold
           shadow-lg shadow-indigo-300
           hover:scale-105 transition duration-300">

        <svg class="w-5 h-5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>

        Create Frame

    </a>

</div>

<!-- Search -->
<div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-lg p-5 mb-8">
    <form method="GET"
        class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search frame..."
            class="rounded-xl border border-slate-200 py-2 bg-slate-100 px-3">


        <select name="status"
            class="rounded-xl border border-slate-200 py-2 bg-slate-100 px-3">

            <option value="">
                All Status
            </option>

            <option value="1"
                {{ request('status')=='1'?'selected':'' }}>
                Active
            </option>

            <option value="0"
                {{ request('status')=='0'?'selected':'' }}>
                Inactive
            </option>

        </select>

        <button
            class="rounded-xl p-2
            bg-slate-600 text-white
            hover:bg-indigo-600
            transition duration-300">

            Search

        </button>

    </form>

</div>


<!-- Cards -->
@if($certificateFrames->count())


<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

    @foreach($certificateFrames as $frame)

    <div class="group bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

        <!-- Preview -->
        <div class="relative h-56 overflow-hidden bg-slate-100">
            @if($frame->background)
            <img src="{{ route('admin.certificate.image', ['filename' => basename($frame->background_url)]) }}"
                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            @else

            <div class=" h-full flex items-center justify-center bg-gradient-to-br from-indigo-200 to-purple-300">
                <span class="text-white font-bold">
                    No Preview
                </span>
            </div>
            @endif

            <!-- Overlay -->
            <div class=" absolute inset-0 bg-black/0 group-hover:bg-black/20 transition">
            </div>

            <!-- Status -->
            <span class=" absolute top-4 right-4 px-4 py-1 rounded-full text-xs font-bold
                {{ $frame->active 
                    ? 'bg-emerald-500 text-white'
                    : 'bg-red-500 text-white'
                }}">
                {{ $frame->active ? 'Active':'Inactive' }}
            </span>
        </div>
        <!-- Content -->
        <div class="p-5">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class=" text-xl font-bold text-slate-800">
                        {{ $frame->frame_name }}
                    </h2>
                    <p class="
                        text-sm text-indigo-600
                        mt-1">

                        {{ ucfirst($frame->category) }}

                    </p>
                </div>


                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    🎓
                </div>
            </div>

            <p class=" text-sm text-slate-500 mt-4 line-clamp-2">
                {{ $frame->description }}
            </p>



            <!-- Actions -->
            <div class=" flex gap-3 mt-6">
                <a href="{{ route('admin.certificate.frames.show',$frame->id) }}"
                    class=" flex-1 text-center py-2 rounded-xl bg-slate-100 hover:bg-indigo-100 transition">
                    View
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>


<!-- Pagination -->
<div class="mt-8">
    {{ $certificateFrames->links() }}
</div>


@else
<!-- Empty -->

<div class=" bg-white/80 backdrop-blur-xl rounded-3xl p-10 text-center">
    <div class="text-6xl mb-4">
        📜
    </div>
    <h2 class="text-xl font-bold">
        No Certificate Frame Found
    </h2>
    <p class="text-slate-500 mt-2">
        Create your first professional certificate template.
    </p>
</div>

@endif
@endsection