<table class="w-full">

    <!-- TABLE HEADER -->
    <thead
        class="bg-gradient-to-r from-sky-600 via-blue-500 to-blue-600 text-white">

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

                {{ $user->email }}

            </td>

            <!-- DATE -->
            <td class="px-6 py-3 text-gray-600">

                {{ $user->created_at->format('d M Y') }}

            </td>

            <!-- STATUS -->
            <td class="px-6 py-3 text-center">

                <span
                    class="bg-green-100/50 border border-green-300 text-green-600
                    px-4 py-2 rounded-full
                    text-sm font-semibold">
                    Active
                </span>

            </td>

            <!-- ACTION -->
            <td class="px-6 py-3">

                <div
                    class="flex items-center
                    justify-center gap-3">

                    <!-- NEON BUTTON -->
                    <button
                        class="relative px-3 py-1
                        rounded-2xl font-bold text-md
                        text-cyan-400 border border-cyan-400
                        overflow-hidden
                        transition duration-500
                        hover:text-black
                        hover:shadow-[0_0_30px_rgba(34,211,238,0.9)]">

                        <span
                            class="absolute inset-0
                            bg-cyan-400 scale-x-0
                            origin-left
                            transition duration-500
                            hover:scale-x-100"></span>

                        <span class="relative z-10">
                            View
                        </span>

                    </button>

                    <!-- NEON BUTTON -->
                    <button
                        class="relative px-2 py-1
                        rounded-2xl font-bold text-md
                        text-red-400 border border-red-400
                        overflow-hidden
                        transition duration-500
                        hover:text-black
                        hover:shadow-[0_0_30px_rgba(255,0,0,0.9)]">

                        <span
                            class="absolute inset-0
                            bg-red-400 scale-x-0
                            origin-left
                            transition duration-500
                            hover:scale-x-100"></span>

                        <span class="relative z-10">
                            Delete
                        </span>

                    </button>
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