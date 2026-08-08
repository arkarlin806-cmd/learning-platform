<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_task_progress', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('goal_id')
                ->constrained('learning_goals')
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->constrained('roadmap_tasks')
                ->cascadeOnDelete();

            $table->boolean('completed')->default(false);

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->unique([
                'user_id',
                'goal_id',
                'task_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_task_progress');
    }
};
