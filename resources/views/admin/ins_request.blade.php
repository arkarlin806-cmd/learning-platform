@extends('layout.admin')

@section('page_title','Instructor Requests')
@section('page','Admin analysis accept and reject instructor requests.')

@section('content')

<div class="max-w-7xl mx-auto px-4">

    {{-- Header --}}

    <div class="flex justify-between lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">
        <div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-200/50 border border-sky-300 text-sky-800 text-sm font-semibold"> <i class="ri-bank-card-line"></i> Request Management </span>
            <h1 class="mt-4 text-xl lg:text-3xl font-black text-gray-800"> Instructor Requests </h1>
            <p class="text-gray-500 mt-2"> All Instructor Requests Management. </p>
        </div>
        <div class="flex gap-3">
            <div class="bg-white rounded-2xl shadow px-6 py-4">
                <p class="text-sm text-gray-500">
                    Total Requests
                </p>
                <h2 class="text-2xl font-bold">
                    {{ $requests->total() }}
                </h2>
            </div>

        </div>
    </div>
    {{-- Search --}}
    <form method="GET" class="mb-6 stat-card opacity-0 animate-stat-in" style="animation-delay:0ms">

        <div class="bg-white rounded-2xl shadow p-5">

            <div class="grid md:grid-cols-3 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search name or email..."
                    class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <select
                    name="status"
                    class="border rounded-xl px-4 py-3">

                    <option value="">
                        All Status
                    </option>

                    <option value="pending"
                        @selected(request('status')=='pending' )>
                        Pending
                    </option>

                    <option value="approved"
                        @selected(request('status')=='approved' )>
                        Approved
                    </option>

                    <option value="rejected"
                        @selected(request('status')=='rejected' )>
                        Rejected
                    </option>

                </select>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                    Search

                </button>

            </div>

        </div>

    </form>

    {{-- Table --}}
    <div class="stat-card opacity-0 animate-stat-in bg-white rounded-3xl shadow overflow-hidden" style="animation-delay:250ms">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            #
                        </th>

                        <th class="px-6 py-4 text-left">
                            User
                        </th>

                        <th class="px-6 py-4 text-left">
                            Profession
                        </th>

                        <th class="px-6 py-4 text-left">
                            Experience
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left">
                            Date
                        </th>

                        <th class="px-6 py-4 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($requests as $request)

                    <tr class="border-b hover:bg-gray-50 duration-200">

                        <td class="px-6 py-5">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-5">

                            <div>

                                <h3 class="font-semibold">
                                    {{ $request->full_name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $request->email }}
                                </p>

                            </div>
                        </td>

                        <td class="px-6 py-5">
                            {{ $request->profession }}
                        </td>

                        <td class="px-6 py-5">
                            {{ $request->experience }}
                        </td>

                        <td class="px-6 py-5">

                            @if($request->status=="pending")

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                Pending
                            </span>

                            @elseif($request->status=="approved")

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                Approved
                            </span>

                            @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                Rejected
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-5">

                            {{ $request->created_at->format('d M Y') }}

                        </td>

                        <td class="px-6 py-5 text-center">

                            <a
                                href="{{ route('instructor.requests.show',$request->id) }}"
                                class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-10 text-gray-500">

                            No instructor requests found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-8">

        {{ $requests->withQueryString()->links() }}

    </div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>
    Swal.fire({

        icon: 'success',

        title: 'Success',

        text: '{{ session("success") }}',

        timer: 2000,

        showConfirmButton: false

    });
</script>

@endif


@if(session('error'))

<script>
    Swal.fire({

        icon: 'error',

        title: 'Failed',

        text: '{{ session("error") }}'

    });
</script>

@endif

@endsection