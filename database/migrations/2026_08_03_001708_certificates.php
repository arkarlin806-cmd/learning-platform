<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('certificates', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Relations
            |--------------------------------------------------------------------------
            */


            // Learner
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();



            // Course
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();



            // Instructor who issued
            $table->foreignId('instructor_id')
                ->constrained('users')
                ->cascadeOnDelete();



            // Admin created frame
            $table->foreignId('certificate_frame_id')
                ->constrained('certificate_frames')
                ->cascadeOnDelete();




            /*
            |--------------------------------------------------------------------------
            | Certificate Identity
            |--------------------------------------------------------------------------
            */


            $table->string('certificate_id')
                ->unique();


            $table->string('verification_hash')
                ->unique();



            /*
            |--------------------------------------------------------------------------
            | QR Verification
            |--------------------------------------------------------------------------
            */


            $table->string('qr_code')
                ->nullable();




            /*
            |--------------------------------------------------------------------------
            | Instructor Custom Content
            |--------------------------------------------------------------------------
            */


            // Max 15 words
            $table->string('description', 500)
                ->nullable();



            // Instructor uploaded signature
            $table->string('signature')
                ->nullable();




            /*
            |--------------------------------------------------------------------------
            | Certificate Status
            |--------------------------------------------------------------------------
            */


            $table->enum(
                'status',
                [
                    'valid',
                    'revoked'
                ]
            )
                ->default('valid');



            $table->timestamp('issued_at')
                ->nullable();



            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
