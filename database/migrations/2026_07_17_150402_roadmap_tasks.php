<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roadmap_tasks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('phase_id')
                ->constrained('roadmap_phases')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            // Optional: link to your platform course
            $table->foreignId('course_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('estimated_minutes')->default(60);

            $table->integer('lesson_count')->default(1);

            $table->integer('practice_count')->default(1);

            $table->integer('sort_order')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap_tasks');
    }
};
