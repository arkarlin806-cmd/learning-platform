<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\CourseSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseScheduleReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $course;
    public $schedule;
    public function __construct(
        Course $course,
        CourseSchedule $schedule
    ) {
        $this->course = $course;
        $this->schedule = $schedule;
    }


    public function build()
    {
        return $this
            ->subject('Course Reminder - Starts in 3 Minutes')
            ->view('emails.course_schedule_reminder')
            ->with([
                'course' => $this->course,
                'schedule' => $this->schedule,
            ]);
    }
}
