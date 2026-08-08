@extends('layout.admin')

@section('title','Instructor Request Details')

@section('content')

<div class="max-w-6xl mx-auto px-4 ">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Instructor Request
            </h1>

            <p class="text-gray-500 mt-2">
                Review instructor application details.
            </p>

        </div>

        <a href="{{ route('instructor.requests.index') }}"
            class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 transition">

            Back

        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl shadow p-8">

                <div class="flex items-center gap-5">

                    <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-700">

                        {{ strtoupper(substr($requestData->full_name,0,1)) }}

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold">

                            {{ $requestData->full_name }}

                        </h2>

                        <p class="text-gray-500">

                            {{ $requestData->email }}

                        </p>

                    </div>

                </div>

                <hr class="my-8">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="text-gray-500 text-sm">

                            Phone

                        </label>

                        <div class="font-semibold mt-1">

                            {{ $requestData->phone }}

                        </div>

                    </div>

                    <div>

                        <label class="text-gray-500 text-sm">

                            Profession

                        </label>

                        <div class="font-semibold mt-1">

                            {{ $requestData->profession }}

                        </div>

                    </div>

                    <div>

                        <label class="text-gray-500 text-sm">

                            Experience

                        </label>

                        <div class="font-semibold mt-1">

                            {{ $requestData->experience }}

                        </div>

                    </div>

                    <div>

                        <label class="text-gray-500 text-sm">

                            Applied Date

                        </label>

                        <div class="font-semibold mt-1">

                            {{ $requestData->created_at->format('d M Y h:i A') }}

                        </div>

                    </div>

                </div>

                <div class="mt-8">

                    <label class="text-gray-500 text-sm">

                        Biography

                    </label>

                    <div class="mt-2 rounded-2xl bg-gray-50 p-5 leading-8">

                        {{ $requestData->bio }}

                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-5 mt-8">

                    @if($requestData->cv)

                    <a href="{{ asset('storage/'.$requestData->cv) }}"
                        target="_blank"
                        class="rounded-2xl bg-blue-50 hover:bg-blue-100 p-5 text-center transition">

                        📄 View CV

                    </a>

                    @endif


                    @if($requestData->certificate)

                    <a href="{{ asset('storage/'.$requestData->certificate) }}"
                        target="_blank"
                        class="rounded-2xl bg-green-50 hover:bg-green-100 p-5 text-center transition">

                        🎓 View Certificate

                    </a>
                    @endif

                </div>

            </div>

        </div>

        {{-- Right --}}
        <div>

            <div class="bg-white rounded-3xl shadow p-8">

                <h3 class="font-bold text-xl mb-6">

                    Request Status

                </h3>

                <div class="mb-6">

                    @if($requestData->status=="pending")

                    <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">

                        Pending

                    </span>

                    @elseif($requestData->status=="approved")

                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-700">

                        Approved

                    </span>

                    @else

                    <span class="px-4 py-2 rounded-full bg-red-100 text-red-700">

                        Rejected

                    </span>

                    @endif

                </div>

                @if($requestData->status=="pending")

                <form id="statusForm"
                    action="{{ route('instructor.requests.update',$requestData->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <label class="font-medium">

                        Change Status

                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full mt-2 border rounded-xl p-3">

                        <option value="approved">

                            Approve

                        </option>

                        <option value="rejected">

                            Reject

                        </option>

                    </select>

                    <textarea
                        id="reject_reason"
                        name="reject_reason"
                        rows="5" required
                        placeholder="Reject reason..."
                        class="w-full mt-4 border rounded-xl p-3 hidden"></textarea>

                    <button
                        type="button"
                        onclick="confirmUpdate()"
                        class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-3">

                        Update Status

                    </button>

                </form>

                @else

                @if($requestData->status=="approved")

                <div class="bg-green-50 rounded-2xl p-5">

                    <div class="font-semibold">

                        Approved At

                    </div>

                    <div class="mt-2">

                        {{ optional($requestData->approved_at)->format('d M Y h:i A') }}

                    </div>

                </div>

                @endif

                @if($requestData->status=="rejected")

                <div class="bg-red-50 rounded-2xl p-5">

                    <div class="font-semibold">

                        Reject Reason

                    </div>

                    <div class="mt-2">

                        {{ $requestData->reject_reason }}

                    </div>

                </div>

                @endif

                @endif

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const status = document.getElementById('status');

    if (status) {

        status.addEventListener('change', function() {

            let reason = document.getElementById('reject_reason');

            if (this.value === "rejected") {

                reason.classList.remove('hidden');

            } else {

                reason.classList.add('hidden');

            }

        });

    }

    function confirmUpdate() {
        Swal.fire({

            title: 'Are you sure?',

            text: 'Update instructor request status?',

            icon: 'question',
            showCancelButton: true,

            confirmButtonText: 'Yes, Update'

        }).then((result) => {

            if (result.isConfirmed) {

                document.getElementById('statusForm').submit();

            }

        });

    }
</script>

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