<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roadmap_phases', function (Blueprint $table) {

            $table->id();

            $table->foreignId('roadmap_id')
                ->constrained('learning_roadmaps')
                ->cascadeOnDelete();

            $table->integer('phase_no');

            $table->string('title');

            $table->text('description')->nullable();

            $table->integer('estimated_days')->default(7);

            $table->integer('sort_order')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap_phases');
    }
};
