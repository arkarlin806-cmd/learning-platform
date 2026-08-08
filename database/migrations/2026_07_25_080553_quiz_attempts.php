<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {

            $table->id();


            $table->foreignId('quiz_id')
                ->constrained()
                ->cascadeOnDelete();



            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();



            // User entered quiz time
            $table->timestamp('started_at');



            // User limit expired time
            $table->timestamp('expired_at');



            $table->boolean('submitted')
                ->default(false);



            $table->timestamps();



            $table->unique([
                'quiz_id',
                'user_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
