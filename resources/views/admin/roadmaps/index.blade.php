@extends('layout.admin')

@section('page_title','Learning Roadmaps')

@section('content')

<div class="relative z-10 max-w-7xl mx-auto px-6">

    <!-- Header -->

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">

        <div>

            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">

                <i class="ri-rocket-2-fill"></i>

                AI Powered Dashboard

            </span>

            <h1 class="mt-5 text-4xl font-black tracking-tight text-gray-900">

                Learning Roadmaps

            </h1>

            <p class="mt-3 text-gray-500 text-lg">

                Create and manage intelligent learning roadmaps for every learner.

            </p>

        </div>

        <a href="{{ route('admin.roadmaps.create') }}"

            class="group relative overflow-hidden rounded-2xl">

            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 transition duration-500 group-hover:scale-110"></div>

            <div class="relative px-8 py-4 text-white font-semibold flex items-center gap-3">

                <i class="ri-add-circle-fill text-xl"></i>

                Create Roadmap

            </div>

        </a>

    </div>

    <!-- Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40
           bg-white/70 backdrop-blur-2xl
           shadow-xl hover:shadow-indigo-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-indigo-500 via-violet-500 to-cyan-500"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2
                           px-3 py-1 rounded-full
                           bg-indigo-50 text-indigo-600
                           text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-indigo-500 animate-pulse"></span>
                            Total Roadmaps
                        </span>



                        <h2
                            class="mt-3 text-3xl font-black
                           bg-gradient-to-r
                           from-indigo-600
                           to-violet-600
                           bg-clip-text
                           text-transparent">

                            {{ $roadmaps->total() }}

                        </h2>

                        <p class="mt-2 text-xs text-slate-600">

                            AI learning templates

                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-xl
                       bg-gradient-to-br
                       from-indigo-500
                       via-violet-500
                       to-purple-600
                       text-white
                       flex items-center justify-center
                       shadow-lg
                       group-hover:rotate-12
                       group-hover:scale-110
                       transition-all duration-500">

                        <i class="ri-road-map-fill text-xl"></i>

                    </div>

                </div>

            </div>

        </div>
        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40
           bg-white/70 backdrop-blur-2xl
           shadow-xl hover:shadow-indigo-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-green-400 via-green-600 to-green-700"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2
                           px-3 py-1 rounded-full
                           bg-green-50 text-green-600
                           text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-green-500 animate-pulse"></span>
                            Ative
                        </span>



                        <h2
                            class="mt-3 text-3xl font-black
                           bg-gradient-to-r
                           from-green-700
                           to-green-800
                           bg-clip-text
                           text-transparent">

                            {{ $roadmaps->where('is_active',1)->count() }}

                        </h2>

                        <p class="mt-2 text-xs text-slate-600">

                            Active templates

                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-xl
                       bg-green-200 text-green-800
                       flex items-center justify-center
                       shadow-lg
                       group-hover:rotate-12
                       group-hover:scale-110
                       transition-all duration-500">

                        <i class="ri-checkbox-circle-fill text-xl"></i>
                    </div>

                </div>

            </div>

        </div>

        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40
           bg-white/70 backdrop-blur-2xl
           shadow-xl hover:shadow-indigo-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-red-500 via-red-700 to-red-800"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2
                           px-3 py-1 rounded-full
                           bg-red-50 text-red-600
                           text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-red-500 animate-pulse"></span>
                            In Active
                        </span>



                        <h2
                            class="mt-3 text-3xl font-black
                           bg-gradient-to-r
                           from-red-600
                           to-red-800
                           bg-clip-text
                           text-transparent">

                            {{ $roadmaps->where('is_active',0)->count() }}

                        </h2>

                        <p class="mt-2 text-xs text-slate-600">

                            In active templates

                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-xl
                       bg-red-200 
                       text-red-700
                       flex items-center justify-center
                       shadow-lg
                       group-hover:rotate-12
                       group-hover:scale-110
                       transition-all duration-500">

                        <i class="ri-close-circle-fill text-xl"></i>

                    </div>

                </div>

            </div>

        </div>
        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40
           bg-white/70 backdrop-blur-2xl
           shadow-xl hover:shadow-indigo-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-yellow-500 via-yellow-700 to-orange-800"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2
                           px-3 py-1 rounded-full
                           bg-yellow-50 text-yellow-600
                           text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-yellow-500 animate-pulse"></span>
                            Page
                        </span>



                        <h2
                            class="mt-3 text-3xl font-black
                           bg-gradient-to-r
                           from-yellow-600
                           to-yellow-800
                           bg-clip-text
                           text-transparent">

                            {{ $roadmaps->count() }}

                        </h2>

                        <p class="mt-2 text-xs text-slate-600">

                            pages

                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-xl
                       bg-yellow-200 
                       text-yellow-700
                       flex items-center justify-center
                       shadow-lg
                       group-hover:rotate-12
                       group-hover:scale-110
                       transition-all duration-500">

                        <i class="ri-pages-fill text-xl"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Search -->

    <form method="GET"

        class="rounded-[32px] bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl p-6 mb-10">

        <div class="grid lg:grid-cols-3 gap-5">

            <div class="relative">

                <i class="ri-search-line absolute left-5 top-4 text-gray-400 text-xl"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search career..."

                    class="w-full pl-14 pr-5 py-4 rounded-2xl border border-slate-200 bg-slate-100 focus:ring-2 focus:ring-indigo-500">

            </div>

            <select

                name="status"

                class="rounded-2xl border border-slate-200 bg-slate-100 px-5">

                <option value="">All Status</option>

                <option value="1"

                    {{ request('status')=='1' ? 'selected' : '' }}>

                    Active

                </option>

                <option value="0"

                    {{ request('status')=='0' ? 'selected' : '' }}>

                    Inactive

                </option>

            </select>

            <button

                class="rounded-2xl bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 text-white font-semibold hover:scale-105 transition">

                Search Roadmaps

            </button>

        </div>

    </form>

    <!-- Roadmap Cards -->

    <div id="roadmapList"

        class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
        @forelse($roadmaps as $roadmap)

        <div
            class="group relative overflow-hidden rounded-[32px]
           bg-white/70 backdrop-blur-2xl
           border border-white/50
           shadow-xl hover:shadow-indigo-300/40
           transition-all duration-500
           hover:-translate-y-3">

            <!-- Gradient Hover -->
            <div
                class="absolute inset-0 opacity-0 group-hover:opacity-100
               bg-gradient-to-br
               from-indigo-500/5
               via-violet-500/10
               to-cyan-500/5
               transition duration-500">
            </div>

            <!-- Top Gradient -->
            <div
                class="absolute top-0 left-0 w-full h-1
               bg-gradient-to-r
               from-indigo-500
               via-violet-500
               to-pink-500">
            </div>

            <div class="relative p-7">

                <!-- Header -->

                <div class="flex justify-between items-start">

                    <div>

                        <div
                            class="w-14 h-14 rounded-2xl
                           bg-gradient-to-r
                           from-indigo-500
                           to-violet-600
                           flex items-center justify-center
                           shadow-lg">

                            <i class="ri-road-map-fill text-white text-2xl"></i>

                        </div>

                    </div>

                    @if($roadmap->is_active)

                    <span
                        class="px-4 py-2 rounded-full
                           bg-green-100
                           text-green-700
                           text-xs font-bold
                           animate-pulse">

                        ● Active

                    </span>

                    @else

                    <span
                        class="px-4 py-2 rounded-full
                           bg-red-100
                           text-red-700
                           text-xs font-bold">

                        ● Inactive

                    </span>

                    @endif

                </div>

                <!-- Career -->

                <h2
                    class="mt-5 text-2xl font-black text-gray-900">

                    {{ $roadmap->career }}

                </h2>

                <!-- Description -->

                <p
                    class="mt-4 text-slate-500 text-sm leading-5">

                    {{ Str::limit($roadmap->description,120) }}

                </p>

                <!-- Divider -->

                <div
                    class="my-4 border-t border-dashed border-slate-400">
                </div>

                <!-- Statistics -->

                <div
                    class="grid grid-cols-2 gap-4">

                    <div
                        class="rounded-2xl
                       bg-gradient-to-br
                       from-indigo-50
                       to-indigo-100
                       px-5 py-3 text-center">

                        <h3
                            class="text-3xl font-black text-indigo-600">

                            {{ $roadmap->phases_count }}

                        </h3>

                        <p
                            class="text-sm mt-2 text-gray-600">

                            Phases

                        </p>

                    </div>

                    <div
                        class="rounded-2xl
                       bg-gradient-to-br
                       from-violet-50
                       to-purple-100
                       px-5 py-3 text-center">

                        <h3
                            class="text-3xl font-black text-violet-600">

                            {{ $roadmap->tasks_count }}

                        </h3>

                        <p
                            class="text-sm mt-2 text-gray-600">

                            Tasks

                        </p>

                    </div>

                </div>

                <!-- Footer -->

                <div
                    class="mt-7 flex items-center justify-between text-sm text-gray-400">

                    <span>

                        <i class="ri-time-line"></i>

                        {{ $roadmap->updated_at->diffForHumans() }}

                    </span>

                </div>

                <!-- Buttons -->

                <div
                    class="grid grid-cols-3 gap-3 mt-4">

                    <a
                        href="{{ route('admin.roadmaps.show',$roadmap->id) }}" class="rounded-xl py-3
                       bg-blue-700
                       text-white
                       font-semibold
                       text-center
                       hover:scale-105
                       transition">

                        <i class="ri-eye-line"></i>

                    </a>

                    <a
                        href="{{ route('admin.roadmaps.edit',$roadmap->id) }}"

                        class="rounded-xl py-3
                       bg-amber-700
                       text-white
                       font-semibold
                       text-center
                       hover:scale-105
                       transition">

                        <i class="ri-pencil-line"></i>

                    </a>

                    <button
                        onclick="deleteRoadmap('{{ $roadmap->id }}')"

                        class="rounded-xl py-3
                       bg-red-700
                       text-white
                       font-semibold
                       hover:scale-105
                       transition">

                        <i class="ri-delete-bin-6-line"></i>

                    </button>

                </div>

            </div>

        </div>

        @empty
        <div class="col-span-full">

            <div
                class="relative overflow-hidden
               rounded-[36px]
               bg-white/80
               backdrop-blur-2xl
               border border-white/60
               shadow-2xl
               py-20
               px-10
               text-center">

                <!-- Background Blur -->
                <div class="absolute -top-16 -left-16 w-56 h-56 rounded-full bg-indigo-300/20 blur-[120px]"></div>
                <div class="absolute -bottom-20 -right-16 w-64 h-64 rounded-full bg-pink-300/20 blur-[140px]"></div>

                <div class="relative">

                    <div
                        class="mx-auto
                       w-28 h-28
                       rounded-full
                       bg-gradient-to-br
                       from-indigo-500
                       via-violet-500
                       to-pink-500
                       flex items-center justify-center
                       shadow-2xl
                       animate-bounce">

                        <i class="ri-road-map-line text-white text-5xl"></i>

                    </div>

                    <h2 class="mt-8 text-3xl font-black text-gray-800">

                        No Roadmaps Found

                    </h2>

                    <p class="mt-3 text-gray-500 max-w-lg mx-auto leading-7">

                        There are no learning roadmaps available yet.
                        Create your first AI learning roadmap and start guiding learners.

                    </p>

                    <a href="{{ route('admin.roadmaps.create') }}"
                        class="inline-flex items-center gap-3 mt-8
                      px-8 py-4
                      rounded-2xl
                      bg-gradient-to-r
                      from-indigo-600
                      via-violet-600
                      to-purple-600
                      text-white
                      font-semibold
                      shadow-xl
                      hover:scale-105
                      transition">

                        <i class="ri-add-circle-fill text-xl"></i>

                        Create First Roadmap

                    </a>

                </div>

            </div>

        </div>

        @endforelse

    </div>

    <!-- Pagination -->

    @if($roadmaps->hasPages())

    <div class="mt-12 flex justify-center">

        <div
            class="bg-white/70
               backdrop-blur-xl
               rounded-3xl
               border border-white/50
               shadow-xl
               px-6
               py-4">

            {{ $roadmaps->links() }}

        </div>

    </div>

    @endif

</div>


<style>
    @keyframes fadeUp {

        from {

            opacity: 0;
            transform: translateY(40px);

        }

        to {

            opacity: 1;
            transform: translateY(0);

        }

    }

    @keyframes floating {

        0% {

            transform: translateY(0);

        }

        50% {

            transform: translateY(-8px);

        }

        100% {

            transform: translateY(0);

        }

    }

    .group {

        animation: fadeUp .7s ease both;

    }

    .group:hover {

        animation: floating 2s ease-in-out infinite;

    }

    ::-webkit-scrollbar {

        width: 8px;

    }

    ::-webkit-scrollbar-thumb {

        background: linear-gradient(#6366f1, #8b5cf6);

        border-radius: 20px;

    }

    ::-webkit-scrollbar-track {

        background: #f3f4f6;

    }
</style>

<!-- Loading Overlay -->
<div id="loadingOverlay"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden
            items-center justify-center z-[9999]">

    <div class="bg-white rounded-3xl p-8 shadow-2xl">

        <div
            class="w-14 h-14 border-4 border-indigo-200
                   border-t-indigo-600 rounded-full animate-spin mx-auto">
        </div>

        <p class="mt-4 text-gray-600 font-semibold">
            Deleting roadmap...
        </p>

    </div>

</div>

<!-- Toast -->
<div id="toast"
    class="fixed top-6 right-6 translate-x-[450px]
            transition-all duration-500
            z-[9999]">

    <div id="toastBox"
        class="rounded-2xl shadow-2xl px-6 py-4
                flex items-center gap-3
                text-white">

        <i id="toastIcon" class="ri-checkbox-circle-fill text-2xl"></i>

        <span id="toastMessage">

        </span>

    </div>

</div>

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const loading = document.getElementById('loadingOverlay');

    const toast = document.getElementById('toast');

    const toastBox = document.getElementById('toastBox');

    const toastMessage = document.getElementById('toastMessage');

    const toastIcon = document.getElementById('toastIcon');

    function showLoading() {

        loading.classList.remove('hidden');

        loading.classList.add('flex');

    }

    function hideLoading() {

        loading.classList.remove('flex');

        loading.classList.add('hidden');

    }

    function showToast(message, type = 'success') {

        toastMessage.innerHTML = message;

        if (type === 'success') {

            toastBox.className = 'rounded-2xl shadow-2xl px-6 py-4 flex items-center gap-3 text-white bg-emerald-600';

            toastIcon.className = 'ri-checkbox-circle-fill text-2xl';

        } else {

            toastBox.className = 'rounded-2xl shadow-2xl px-6 py-4 flex items-center gap-3 text-white bg-red-600';

            toastIcon.className = 'ri-close-circle-fill text-2xl';

        }

        toast.classList.remove('translate-x-[450px]');

        setTimeout(() => {

            toast.classList.add('translate-x-[450px]');

        }, 3000);

    }
    // async function deleteRoadmap(id) {


    //     if (!confirm(
    //             "Delete this roadmap?"
    //         ))
    //         return;



    //     let response =
    //         await fetch("{{ route('admin.roadmaps.destroy',':id') }}".replace(':id', id), {

    //             method: "DELETE",

    //             headers: {


    //                 "X-CSRF-TOKEN":

    //                     document
    //                     .querySelector(
    //                         'meta[name="csrf-token"]'
    //                     ).content


    //             }

    //         });



    //     let result =
    //         await response.json();



    //     if (result.status) {

    //         alert(result.message);

    //         location.reload();

    //     }


    // }

    async function deleteRoadmap(id) {

        if (!confirm('Delete this roadmap?')) {

            return;

        }

        showLoading();

        try {

            const response = await fetch(`{{ route('admin.roadmaps.destroy',':id') }}`.replace(':id', id), {

                method: 'DELETE',

                headers: {

                    'X-CSRF-TOKEN': csrf,

                    'Accept': 'application/json'

                }

            });

            const data = await response.json();

            hideLoading();

            if (data.success) {

                showToast(data.message || 'Roadmap deleted successfully.');

                setTimeout(() => {

                    location.reload();

                }, 300);
                // location.reload();
            } else {

                showToast(data.message || 'Delete failed.', 'error');

            }

        } catch (error) {

            hideLoading();

            showToast('Something went wrong.', 'error');

            console.error(error);

        }

    }
</script>
@endsection