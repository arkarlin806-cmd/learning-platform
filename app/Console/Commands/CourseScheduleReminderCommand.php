<?php

// namespace App\Console\Commands;

// use App\Jobs\SendCourseScheduleReminderJob;
// use App\Models\CourseSchedule;
// use Carbon\Carbon;
// use Illuminate\Console\Command;

// class CourseScheduleReminderCommand extends Command
// {
//     protected $signature = 'course_schedule:reminder';

//     protected $description = 'Send course reminder before 3 minutes';

//     public function handle()
//     {

//         $now = Carbon::now();


//         // Today name
//         $today = $now->format('l');


//         // 3 minutes window
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

//             ->where(
//                 'reminder_sent',
//                 false
//             )

//             ->pluck('id');


//         foreach ($schedules as $id) {

//             SendCourseScheduleReminderJob::dispatch($id);
//         }


//         $this->info(
//             $schedules->count()
//                 . ' reminder jobs dispatched.'
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


    public function handle()
    {

        $now = Carbon::now();


        // Today name (Sunday, Monday...)
        $today = $now->format('l');


        // 3 minutes before range
        $from = $now->copy()
            ->addMinutes(3)
            ->startOfMinute()
            ->format('H:i:s');


        $to = $now->copy()
            ->addMinutes(3)
            ->endOfMinute()
            ->format('H:i:s');



        $schedules = CourseSchedule::where('day', $today)

            ->whereBetween(
                'start_time',
                [
                    $from,
                    $to
                ]
            )

            ->get();



        foreach ($schedules as $schedule) {


            // Check already sent today
            $exists = CourseScheduleReminder::where(
                'course_schedule_id',
                $schedule->id
            )

                ->where(
                    'sent_date',
                    today()
                )

                ->exists();



            if ($exists) {
                continue;
            }



            SendCourseScheduleReminderJob::dispatch(
                $schedule->id
            );
        }



        $this->info(
            $schedules->count()
                . ' schedules checked.'
        );
    }
}
