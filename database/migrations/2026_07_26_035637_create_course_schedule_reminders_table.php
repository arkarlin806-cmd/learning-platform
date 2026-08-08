<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('course_schedule_reminders', function (Blueprint $table) {

            $table->id();


            $table->foreignId('course_schedule_id')
                ->constrained('course_schedules')
                ->cascadeOnDelete();


            $table->date('sent_date');


            $table->timestamps();


            // Prevent duplicate reminder
            $table->unique([
                'course_schedule_id',
                'sent_date'
            ]);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('course_schedule_reminders');
    }
};
