@foreach($schedules as $schedule)

<div
    id="schedule-{{ $schedule->id }}"
    class="relative pl-10 mb-8">

    <div
        class="absolute left-0 top-2 w-4 h-4 bg-indigo-600 rounded-full">
    </div>

    <div
        class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between">

            <div>

                <h3 class="font-bold text-xl">

                    {{ $schedule->title }}

                </h3>

                <p class="text-gray-500">

                    {{ $schedule->description }}

                </p>

                <p class="mt-2">

                    {{ $schedule->date }}

                </p>

            </div>

            <div class="flex gap-2">

                <button
                    onclick="editSchedule('{{ $schedule->id }}')"
                    class="px-4 py-2 bg-blue-100 text-blue-600 rounded-xl">

                    Edit

                </button>

                <button
                    onclick="deleteSchedule('{{ $schedule->id }}')"
                    class="px-4 py-2 bg-red-100 text-red-600 rounded-xl">

                    Delete

                </button>

            </div>

        </div>

    </div>

</div>

@endforeach

<div class="mt-6">

    {{ $schedules->links() }}

</div>