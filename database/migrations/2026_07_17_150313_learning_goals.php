<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_goals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('goal_name');

            // Beginner / Intermediate / Advanced
            $table->string('current_level')->default('Beginner');

            // Example: Full Stack Developer
            $table->string('target_role');

            // Study Hours Per Day
            $table->decimal('daily_hours', 4, 1)->default(2);

            // Lessons Per Day
            $table->integer('daily_lessons')->default(2);

            // 5 or 6 Days
            $table->integer('study_days_per_week')->default(6);

            $table->date('estimated_finish_date')->nullable();

            $table->integer('estimated_days')->nullable();

            $table->enum('status', [
                'active',
                'completed',
                'paused'
            ])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_goals');
    }
};
