<table class="w-full">

    <!-- TABLE HEADER -->
    <thead
        class="bg-gradient-to-r from-sky-800 via-blue-800 to-blue-800 text-white">

        <tr>

            <th class="px-6 py-5 text-left">
                User
            </th>

            <th class="px-6 py-5 text-left">
                Email
            </th>

            <th class="px-6 py-5 text-left">
                Joined
            </th>

            <th class="px-6 py-5 text-center">
                Status
            </th>

            <th class="px-6 py-5 text-center">
                Action
            </th>

        </tr>

    </thead>

    <!-- BODY -->
    <tbody>

        @foreach($users as $user)

        <tr
            class="border-b hover:bg-gray-50
            transition duration-300">

            <!-- USER -->
            <td class="px-6 py-3">

                <div class="flex items-center gap-4">

                    <img
                        src="https://ui-avatars.com/api/?name={{ $user->name }}"
                        class="w-14 h-14 rounded-full
                        shadow-lg">

                    <div>

                        <h1
                            class="font-bold text-gray-800">
                            {{ $user->name }}
                        </h1>

                        <p
                            class="text-gray-500 text-sm">
                            ID : {{ $user->id }}
                        </p>

                    </div>

                </div>

            </td>

            <!-- EMAIL -->
            <td class="px-6 py-3 text-blue-700">
                <a href="{{ route('contact.adimn_create',$user->id)}}">
                    {{ $user->email }}
                </a>
            </td>

            <!-- DATE -->
            <td class="px-6 py-3 text-gray-600">

                {{ $user->created_at->format('d M Y') }}

            </td>

            <!-- STATUS -->
            <td class="px-6 py-3 text-center">

                @if($user->status == "active")
                <span
                    class="bg-green-100/50 border border-green-300 text-green-600
                    px-4 py-2 rounded-full
                    text-sm font-semibold">
                    Active
                </span>
                @elseif($user->status == "warning")
                <span
                    class="bg-yellow-100/50 border border-yellow-300 text-yellow-600
                    px-4 py-2 rounded-full
                    text-sm font-semibold">
                    Warning
                </span>
                @else
                <span
                    class="bg-red-100/50 border border-red-300 text-red-600
                    px-4 py-2 rounded-full
                    text-sm font-semibold">
                    Baned
                </span>
                @endif

            </td>

            <!-- ACTION -->
            <td class="px-6 py-3">

                <div
                    class="flex items-center
                    justify-center gap-3">



                    <!-- NEON BUTTON -->
                    @if($user->status === 'active')

                    <form
                        action="{{ route('admin.users.warning', $user) }}"
                        method="POST"
                        class="warning-form">
                        @csrf

                        <button
                            type="button"
                            onclick="confirmWarning(this)"
                            class="px-4 py-2
                                rounded-xl
                                bg-amber-50
                                text-amber-600
                                text-sm
                                font-semibold
                                hover:bg-amber-500
                                hover:text-white
                                transition">
                            ⚠️ Warning
                        </button>

                    </form>@endif
                    @if($user->status === 'warning')

                    <form
                        action="{{ route('admin.users.ban', $user) }}"
                        method="POST"
                        class="ban-form">
                        @csrf

                        <button
                            type="button"
                            onclick="confirmBan(this)"
                            class="px-4 py-2
                                rounded-xl
                                bg-red-50
                                text-red-600
                                text-sm
                                font-semibold
                                hover:bg-red-600
                                hover:text-white
                                transition">
                            🚫 Ban
                        </button>

                    </form>

                    @elseif($user->status === 'banned')

                    <span class="text-xs text-red-500 font-semibold">
                        Already Banned
                    </span>

                    @endif


                    @if(in_array($user->status, ['warning', 'banned']))

                    <form
                        action="{{ route('admin.users.activate', $user) }}"
                        method="POST"
                        class="activate-form">
                        @csrf

                        <button
                            type="button"
                            onclick="confirmActivate(this, '{{ $user->status }}')"
                            class="px-4 py-2
                                        rounded-xl
                                        bg-emerald-50
                                        text-emerald-600
                                        text-sm
                                        font-semibold
                                        hover:bg-emerald-600
                                        hover:text-white
                                        transition">
                            ✓ Activate
                        </button>

                    </form>

                    @endif
                </div>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<!-- PAGINATION -->
<div class="p-6">

    {{ $users->links() }}

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function confirmWarning(button) {
        Swal.fire({

            icon: 'warning',

            title: 'Give Warning?',

            text: 'This learner will receive a warning notification.',

            input: 'textarea',

            inputPlaceholder: 'Enter warning reason...',

            showCancelButton: true,

            confirmButtonText: 'Give Warning',

            cancelButtonText: 'Cancel',

            reverseButtons: true,

            confirmButtonColor: '#f59e0b',

            cancelButtonColor: '#64748b',

            customClass: {
                popup: 'rounded-3xl'
            }

        }).then((result) => {

            if (result.isConfirmed) {

                const form = button.closest('.warning-form');

                const input = document.createElement('input');

                input.type = 'hidden';

                input.name = 'reason';

                input.value =
                    result.value ||
                    'Please follow the platform rules.';

                form.appendChild(input);

                form.submit();
            }

        });
    }



    function confirmBan(button) {
        Swal.fire({

            icon: 'error',

            title: 'Ban this learner?',

            text: 'This learner has already received a warning. Are you sure you want to ban this account?',

            showCancelButton: true,

            confirmButtonText: 'Yes, Ban Learner',

            cancelButtonText: 'Cancel',

            reverseButtons: true,

            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',

            customClass: {
                popup: 'rounded-3xl'
            }

        }).then((result) => {

            if (result.isConfirmed) {

                button
                    .closest('.ban-form')
                    .submit();

            }

        });
    }


    function confirmActivate(button, status) {
        let message = '';

        if (status === 'banned') {
            message = 'This learner is currently banned. Do you want to restore the account?';
        } else {
            message = 'This learner has a warning. Do you want to make the account active again?';
        }

        Swal.fire({

            icon: 'question',

            title: 'Activate Learner?',

            text: message,

            showCancelButton: true,

            confirmButtonText: 'Yes, Activate',

            cancelButtonText: 'Cancel',

            reverseButtons: true,

            confirmButtonColor: '#059669',

            cancelButtonColor: '#64748b',

            customClass: {
                popup: 'rounded-3xl'
            }

        }).then((result) => {

            if (result.isConfirmed) {

                button
                    .closest('.activate-form')
                    .submit();

            }

        });
    }
</script>