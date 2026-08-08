<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lesson_video_segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->foreignId('recording_id')->nullable()->constrained('course_live_recordings')->nullOnDelete();

            $table->unsignedInteger('segment_order')->default(1);
            $table->string('disk')->default('public');
            $table->string('path');
            $table->unsignedBigInteger('size_bytes')->default(0);
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->string('mime_type')->nullable();

            $table->timestamps();

            $table->index(['lesson_id', 'segment_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_video_segments');
    }
};
