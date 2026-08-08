<?php
// database/migrations/2026_01_01_create_ai_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ai_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->text('prompt');
            $table->text('negative_prompt')->nullable();

            $table->string('image_url')->nullable();
            $table->string('status')->default('pending');
            // pending | processing | completed | failed

            $table->string('provider')->default('replicate');

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_images');
    }
};
