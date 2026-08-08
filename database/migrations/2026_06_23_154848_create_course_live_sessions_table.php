<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_live_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('instructor_id')->constrained('users')->cascadeOnDelete();

            $table->string('uuid')->unique();
            $table->string('room_name')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('status', ['scheduled', 'live', 'ended'])->default('scheduled');

            $table->boolean('recording_enabled')->default(false);
            $table->boolean('recording_imported')->default(false);

            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->nullOnDelete();

            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['course_id', 'status']);
            $table->index(['instructor_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_live_sessions');
    }
};
