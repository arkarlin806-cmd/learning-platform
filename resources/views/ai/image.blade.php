@extends('layout.ai')

@section('content')


<div class="app-shell w-full flex-1 overflow-y-auto">

    <!-- Header -->
    <header class="top-fade header-glass">
        <div class="max-w-6xl mx-auto px-3 md:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">

                <button id="openSidebar"
                    class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                    ☰
                </button>
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                    AI
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        AI Image Generator
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Generating anything, get clean image instantly
                    </p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="status-pill text-xs px-3 py-1.5 rounded-full">
                    Smart generator
                </span>
            </div>
        </div>
    </header>

    {{-- FORM --}}
    <div class="bg-orange-100 shadow rounded md:mx-14 mx-8 p-10 rounded-3xl mb-6 mt-8">
        <h2 class="text-2xl font-bold mb-3">AI Image <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                Generator
            </span></h2>

        <form id="generateForm">
            @csrf

            <textarea
                name="prompt"
                id="prompt"
                class="w-full border border-cyan-700 rounded-2xl p-2 mb-3"
                rows="3"
                placeholder="Enter your prompt..."
                required></textarea>

            <input
                type="text"
                name="negative_prompt"
                class="w-full border rounded-2xl border-cyan-700 p-2 mb-3"
                placeholder="Negative prompt (optional)">

            <select name="image_type" required class="w-full border border-cyan-700 rounded-2xl p-2 mt-2 mb-3">
                <option value="realistic">Realistic</option>
                <option value="anime">Anime</option>
                <option value="3d">3D Render</option>
                <option value="cinematic">Cinematic</option>
            </select>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:text-bold my-4">
                Generate
            </button>
        </form>
    </div>

    {{-- PROGRESS --}}
    <div id="progressBox" class="hidden bg-yellow-100 md:mx-14 mx-8 px-14 rounded mb-6">
        <p class="font-bold">Generating Image...</p>
        <div class="w-full bg-gray-300 rounded h-3 mt-2">
            <div id="progressBar" class="bg-blue-600 h-3 rounded" style="width:0%"></div>
        </div>
        <p id="progressText" class="mt-2 text-sm"></p>
    </div>

    {{-- HISTORY --}}
    <div class="md:mx-14 mx-8 px-8 bg-white pt-6 rounded-2xl">
        <h2 class="text-2xl font-bold mb-6">Your
            <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                Images
            </span>
        </h2>

        <div id="imageGrid" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- JS inject --}}
        </div>
    </div>
</div>

{{-- SWEET ALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let currentImageId = null;
    let interval = null;

    /* SUBMIT FORM */
    document.getElementById('generateForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        let res = await fetch(`{{ route('ai-images.store') }}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        let data = await res.json();

        if (data.id) {
            currentImageId = data.id;

            Swal.fire({
                icon: 'success',
                title: 'Started!',
                text: 'Image generation started'
            });

            document.getElementById('progressBox').classList.remove('hidden');

            startPolling(currentImageId);
            loadHistory();
        }
    });

    /* POLLING PROGRESS */
    function startPolling(id) {

        if (interval) clearInterval(interval);

        interval = setInterval(async () => {

            let res = await fetch(`{{ route('ai-images.status',':id') }}`.replace(':id', id));
            let data = await res.json();

            document.getElementById('progressBar').style.width = data.progress + "%";
            document.getElementById('progressText').innerText =
                data.status + " (" + data.progress + "%)";

            if (data.status === 'completed') {

                clearInterval(interval);

                document.getElementById('progressText').innerText = "Completed!";

                Swal.fire({
                    icon: 'success',
                    title: 'Done!',
                    text: 'Your image is ready'
                });

                loadHistory();
            }

            if (data.status === 'failed') {

                clearInterval(interval);

                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: 'Image generation failed'
                });
            }

        }, 2000);
    }

    /* LOAD HISTORY */
    async function loadHistory() {

        let res = await fetch(`{{ route('ai-images.index') }}`);
        let data = await res.json();

        let html = "";

        data.data.forEach(img => {
            html += `
            <div class="border border-slate-300 rounded-3xl overflow-hidden shadow hover:shadow-xl hover:shadow-yellow-100">
                <div class="p-2 text-sm">
                    <b>Status:</b> <span class="text-slate-500">
                         <span class="text-slate-600 ">${img.status}</span>
                    </span>
                </div>

                ${img.image_url ?
                   ` <img src="${img.image_url}" class="w-full h-48 object-cover">`
                    :
                   ` <div class="p-6 text-center text-gray-500">Processing...</div>`
                }

                <div class="p-2 text-xs text-gray-600">
                    ${img.prompt.substring(0, 60)}...
                </div>
            </div>
        `;
        });

        document.getElementById('imageGrid').innerHTML = html;
    }

    /* INIT */
    loadHistory();
</script>

@endsection