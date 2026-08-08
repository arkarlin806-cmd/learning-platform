<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('group_chat_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('reply_id')
                ->nullable()
                ->constrained('group_messages')
                ->nullOnDelete();
                
            $table->text('message')->nullable();

            $table->string('file')->nullable();

            $table->boolean('is_edited')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('group_messages', function (Blueprint $table) {

            $table->dropColumn([
                'reply_id',
                'is_edited'
            ]);

        });
    }
};