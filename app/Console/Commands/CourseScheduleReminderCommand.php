<?php

// namespace App\Console\Commands;

// use App\Models\CourseSchedule;
// use App\Models\CourseScheduleReminder;
// use App\Jobs\SendCourseScheduleReminderJob;
// use Carbon\Carbon;
// use Illuminate\Console\Command;

// class CourseScheduleReminderCommand extends Command
// {
//     protected $signature = 'course_schedule:reminder';

//     protected $description = 'Send course schedule reminder emails';

//     public function handle(): int
//     {
//         $now = Carbon::now();

//         // Today: Sunday, Monday, Tuesday...
//         $today = $now->format('l');

//         /*
//          * Check schedules starting within the next 3 minutes.
//          *
//          * Example:
//          * Current time = 17:27
//          * We check 17:30:00 - 17:30:59
//          */
//         $target = $now->copy()->addMinutes(3);

//         $from = $target->copy()
//             ->startOfMinute()
//             ->format('H:i:s');

//         $to = $target->copy()
//             ->endOfMinute()
//             ->format('H:i:s');

//         $schedules = CourseSchedule::where('day', $today)
//             ->whereBetween('start_time', [$from, $to])
//             ->get();

//         $dispatched = 0;
//         $skipped = 0;

//         foreach ($schedules as $schedule) {

//             // Prevent duplicate reminder on the same day
//             $exists = CourseScheduleReminder::where(
//                 'course_schedule_id',
//                 $schedule->id
//             )
//                 ->whereDate('sent_date', today())
//                 ->exists();

//             if ($exists) {
//                 $skipped++;
//                 continue;
//             }

//             SendCourseScheduleReminderJob::dispatch(
//                 $schedule->id
//             );

//             $dispatched++;
//         }

//         $this->info(
//             "Found: {$schedules->count()} | " .
//                 "Dispatched: {$dispatched} | " .
//                 "Skipped: {$skipped}"
//         );

//         return self::SUCCESS;
//     }
// }


namespace App\Console\Commands;

use App\Models\CourseSchedule;
use App\Models\CourseScheduleReminder;
use App\Jobs\SendCourseScheduleReminderJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CourseScheduleReminderCommand extends Command
{
    protected $signature = 'course_schedule:reminder';

    protected $description = 'Send course schedule reminder emails';

    public function handle(): int
    {
        $now = Carbon::now();

        $today = $now->format('l');

        /*
         * Production-safe reminder window.
         *
         * Check schedules starting between:
         * now + 2 minutes
         * and
         * now + 4 minutes
         *
         * This gives scheduler some tolerance for execution delay.
         */
        $from = $now->copy()
            ->addMinutes(2)
            ->startOfMinute()
            ->format('H:i:s');

        $to = $now->copy()
            ->addMinutes(4)
            ->endOfMinute()
            ->format('H:i:s');

        $schedules = CourseSchedule::where('day', $today)
            ->whereBetween('start_time', [$from, $to])
            ->get();

        $dispatched = 0;
        $skipped = 0;

        foreach ($schedules as $schedule) {

            $exists = CourseScheduleReminder::where(
                'course_schedule_id',
                $schedule->id
            )
                ->whereDate('sent_date', today())
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            SendCourseScheduleReminderJob::dispatch(
                $schedule->id
            );

            $dispatched++;
        }

        $this->info(
            "Found: {$schedules->count()} | " .
                "Dispatched: {$dispatched} | " .
                "Skipped: {$skipped}"
        );

        return self::SUCCESS;
    }
}
