<?php

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


class SendCourseScheduleReminderJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;
    public $scheduleId;
    public function __construct($scheduleId)
    {
        $this->scheduleId = $scheduleId;
    }

    public function handle()
    {
        $schedule = CourseSchedule::with([
            'course.instructor',
            'course.orders.user'
        ])
            ->find($this->scheduleId);
        if (!$schedule) {
            return;
        }
        $course = $schedule->course;
        /*
        |--------------------------------------------------------------------------
        | Instructor Email
        |--------------------------------------------------------------------------
        */
        if (
            $course->instructor &&
            $course->instructor->email
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
        |--------------------------------------------------------------------------
        | Paid Learners Email
        |--------------------------------------------------------------------------
        */
        foreach ($course->orders as $order) {

            if ($order->status != 'paid') {
                continue;
            }

            if (!$order->user) {
                continue;
            }

            if (!$order->user->email) {
                continue;
            }

            // Notification OFF
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

        /*
        |--------------------------------------------------------------------------
        | Save Reminder Log
        |--------------------------------------------------------------------------
        */
        CourseScheduleReminder::create([

            'course_schedule_id'
            => $schedule->id,
            'sent_date'
            => today()

        ]);
    }
}
