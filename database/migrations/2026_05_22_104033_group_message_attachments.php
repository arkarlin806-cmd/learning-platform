<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_message_attachments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('group_message_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('file');
            $table->string('type');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_message_attachments');
    }
};