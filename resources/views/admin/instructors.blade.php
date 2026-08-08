@extends('layout.admin')

@section('content')
@section('page_title')
Instructor Management
@endsection
<!-- HEADER -->
<div
    class="flex flex-col md:flex-row bg-white/80 rounded-3xl shadow-lg shadow-blue-300 p-6
        md:items-center md:justify-between
        gap-5 mb-8 animate-fadeIn">
    <div>
        <h1 class="gradient-shine text-4xl font-extrabold">
            Instructor Management
        </h1>
        <p class="text-gray-500 mt-2">
            Modern Realtime Users Table
        </p>

    </div>
    <!-- SEARCH -->
    <div class="relative">

        <input
            type="text"
            id="searchInput"
            placeholder="Search users..."
            class="w-full md:w-80
                bg-white border border-gray-200
                rounded-2xl px-5 py-3
                outline-none
                focus:ring-4 focus:ring-indigo-200
                shadow-lg transition duration-300">

    </div>

</div>

<!-- TABLE -->
<div
    class="bg-white rounded-3xl
        shadow-md overflow-hidden
        animate-slideUp">

    <div
        id="tableData"
        class="overflow-x-auto">

        @include('admin.table')

    </div>

</div>


<script>
    // LOAD USERS
    const usersRoute = "{{ route('admin.instructors') }}";

    async function instructorUser(page = 1, search = '') {

        const response =
            await fetch(`${usersRoute}?page=${page}&search=${encodeURIComponent(search)}`, {

                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }

            });

        const data = await response.text();

        document.getElementById('tableData')
            .innerHTML = data;

    }

    // SEARCH
    document.getElementById('searchInput')
        .addEventListener('keyup', function() {

            instructorUser(1, this.value);

        });

    // PAGINATION NO REFRESH
    document.addEventListener('click', function(e) {

        if (e.target.closest('.pagination a')) {

            e.preventDefault();

            const url =
                e.target.closest('.pagination a').href;

            const page =
                new URL(url).searchParams.get('page');

            const search =
                document.getElementById('searchInput').value;

            instructorUser(page, search);

        }

    });
</script>


@endsection