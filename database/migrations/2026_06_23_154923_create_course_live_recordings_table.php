<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_live_recordings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_session_id')->constrained('course_live_sessions')->cascadeOnDelete();

            $table->string('source_type')->default('manual_upload'); // manual_upload / jibri / external
            $table->string('original_name')->nullable();
            $table->string('disk')->default('public');
            $table->string('path')->nullable();
            $table->unsignedBigInteger('size_bytes')->default(0);
            $table->unsignedInteger('duration_seconds')->nullable();

            $table->string('mime_type')->nullable();
            $table->string('checksum')->nullable();

            $table->boolean('is_processed')->default(false);
            $table->boolean('is_split')->default(false);

            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_live_recordings');
    }
};
