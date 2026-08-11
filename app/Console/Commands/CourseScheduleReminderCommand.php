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


//     public function handle()
//     {

//         $now = Carbon::now();


//         // Today name (Sunday, Monday...)
//         $today = $now->format('l');


//         // 3 minutes before range
//         $from = $now->copy()
//             ->addMinutes(3)
//             ->startOfMinute()
//             ->format('H:i:s');


//         $to = $now->copy()
//             ->addMinutes(3)
//             ->endOfMinute()
//             ->format('H:i:s');



//         $schedules = CourseSchedule::where('day', $today)

//             ->whereBetween(
//                 'start_time',
//                 [
//                     $from,
//                     $to
//                 ]
//             )

//             ->get();



//         foreach ($schedules as $schedule) {


//             // Check already sent today
//             $exists = CourseScheduleReminder::where(
//                 'course_schedule_id',
//                 $schedule->id
//             )

//                 ->where(
//                     'sent_date',
//                     today()
//                 )

//                 ->exists();



//             if ($exists) {
//                 continue;
//             }



//             SendCourseScheduleReminderJob::dispatch(
//                 $schedule->id
//             );
//         }



//         $this->info(
//             $schedules->count()
//                 . ' schedules checked.'
//         );
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

        // Today: Sunday, Monday, Tuesday...
        $today = $now->format('l');

        /*
         * Check schedules starting within the next 3 minutes.
         *
         * Example:
         * Current time = 17:27
         * We check 17:30:00 - 17:30:59
         */
        $target = $now->copy()->addMinutes(3);

        $from = $target->copy()
            ->startOfMinute()
            ->format('H:i:s');

        $to = $target->copy()
            ->endOfMinute()
            ->format('H:i:s');

        $schedules = CourseSchedule::where('day', $today)
            ->whereBetween('start_time', [$from, $to])
            ->get();

        $dispatched = 0;
        $skipped = 0;

        foreach ($schedules as $schedule) {

            // Prevent duplicate reminder on the same day
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
