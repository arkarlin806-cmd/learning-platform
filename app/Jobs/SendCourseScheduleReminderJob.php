<?php

// namespace App\Jobs;

// use App\Models\CourseSchedule;
// use App\Models\CourseScheduleReminder;
// use App\Mail\CourseScheduleReminderMail;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Mail;


// class SendCourseScheduleReminderJob implements ShouldQueue
// {
//     use Dispatchable,
//         InteractsWithQueue,
//         Queueable,
//         SerializesModels;
//     public $scheduleId;
//     public function __construct($scheduleId)
//     {
//         $this->scheduleId = $scheduleId;
//     }

//     public function handle()
//     {
//         $schedule = CourseSchedule::with([
//             'course.instructor',
//             'course.orders.user'
//         ])
//             ->find($this->scheduleId);
//         if (!$schedule) {
//             return;
//         }
//         $course = $schedule->course;
//         /*
//         |--------------------------------------------------------------------------
//         | Instructor Email
//         |--------------------------------------------------------------------------
//         */
//         if (
//             $course->instructor &&
//             $course->instructor->email
//         ) {
//             Mail::to($course->instructor->email)
//                 ->send(
//                     new CourseScheduleReminderMail(
//                         $course,
//                         $schedule
//                     )
//                 );
//         }
//         /*
//         |--------------------------------------------------------------------------
//         | Paid Learners Email
//         |--------------------------------------------------------------------------
//         */
//         foreach ($course->orders as $order) {

//             if ($order->status != 'paid') {
//                 continue;
//             }

//             if (!$order->user) {
//                 continue;
//             }

//             if (!$order->user->email) {
//                 continue;
//             }

//             // Notification OFF
//             if (!$order->user->email_schedule_notification) {
//                 continue;
//             }

//             Mail::to($order->user->email)

//                 ->send(

//                     new CourseScheduleReminderMail(
//                         $course,
//                         $schedule
//                     )
//                 );
//         }

//         /*
//         |--------------------------------------------------------------------------
//         | Save Reminder Log
//         |--------------------------------------------------------------------------
//         */
//         CourseScheduleReminder::create([

//             'course_schedule_id'
//             => $schedule->id,
//             'sent_date'
//             => today()

//         ]);
//     }
// }



namespace App\Jobs;

use App\Models\CourseSchedule;
use App\Models\CourseScheduleReminder;
use App\Mail\CourseScheduleReminderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendCourseScheduleReminderJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $scheduleId;

    public int $tries = 3;

    public int $timeout = 120;

    public function __construct(int $scheduleId)
    {
        $this->scheduleId = $scheduleId;
    }

    public function handle(): void
    {
        $schedule = CourseSchedule::with([
            'course.instructor',
            'course.orders.user',
        ])->find($this->scheduleId);

        if (!$schedule) {
            Log::warning(
                'Course schedule not found',
                ['schedule_id' => $this->scheduleId]
            );

            return;
        }

        /*
         * Prevent duplicate sending if another worker
         * already completed this reminder.
         */
        $alreadySent = CourseScheduleReminder::where(
            'course_schedule_id',
            $schedule->id
        )
            ->whereDate('sent_date', today())
            ->exists();

        if ($alreadySent) {
            Log::info(
                'Course schedule reminder already sent',
                ['schedule_id' => $schedule->id]
            );

            return;
        }

        $course = $schedule->course;

        /*
         * Instructor
         */
        if (
            $course &&
            $course->instructor &&
            !empty($course->instructor->email)
        ) {
            Mail::to($course->instructor->email)
                ->send(
                    new CourseScheduleReminderMail(
                        $course,
                        $schedule
                    )
                );
        }

        /*
         * Paid learners
         */
        if ($course) {
            foreach ($course->orders as $order) {

                if ($order->status !== 'paid') {
                    continue;
                }

                if (!$order->user) {
                    continue;
                }

                if (empty($order->user->email)) {
                    continue;
                }

                if (!$order->user->email_schedule_notification) {
                    continue;
                }

                Mail::to($order->user->email)
                    ->send(
                        new CourseScheduleReminderMail(
                            $course,
                            $schedule
                        )
                    );
            }
        }

        /*
         * Only create reminder record AFTER
         * all emails have been successfully sent.
         */
        CourseScheduleReminder::create([
            'course_schedule_id' => $schedule->id,
            'sent_date' => today(),
        ]);

        Log::info(
            'Course schedule reminder sent successfully',
            ['schedule_id' => $schedule->id]
        );
    }

    public function failed(\Throwable $exception): void
    {
        Log::error(
            'Course schedule reminder job failed',
            [
                'schedule_id' => $this->scheduleId,
                'error' => $exception->getMessage(),
            ]
        );
    }
}
