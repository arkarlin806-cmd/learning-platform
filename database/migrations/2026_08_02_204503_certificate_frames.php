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
        Schema::create('certificate_frames', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('category')->nullable();
            $table->string('frame_name');
            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Background Design
            |--------------------------------------------------------------------------
            */

            $table->string('background')->nullable();
            $table->string('border_image')->nullable();
            $table->string('watermark')->nullable();
            $table->string('hologram')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */

            $table->string('logo')->nullable();
            $table->string('signature')->nullable();
            $table->string('seal')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Colors
            |--------------------------------------------------------------------------
            */

            $table->string('primary_color')->default('#1e3a8a');
            $table->string('secondary_color')->default('#d4af37');
            $table->string('accent_color')->default('#0f172a');
            $table->string('text_color')->default('#111827');

            /*
            |--------------------------------------------------------------------------
            | Fonts
            |--------------------------------------------------------------------------
            */

            $table->string('title_font')->default('Poppins');
            $table->string('body_font')->default('Inter');
            $table->string('name_font')->default('Playfair Display');

            $table->integer('title_size')->default(42);
            $table->integer('name_size')->default(34);
            $table->integer('body_size')->default(18);

            /*
            |--------------------------------------------------------------------------
            | Position
            |--------------------------------------------------------------------------
            */

            $table->string('logo_position')->default('top-center');
            $table->string('signature_position')->default('bottom-left');
            $table->string('seal_position')->default('bottom-right');
            $table->string('qr_position')->default('bottom-center');

            /*
            |--------------------------------------------------------------------------
            | Alignment
            |--------------------------------------------------------------------------
            */

            $table->string('title_alignment')->default('center');
            $table->string('name_alignment')->default('center');
            $table->string('body_alignment')->default('center');

            /*
            |--------------------------------------------------------------------------
            | Display Options
            |--------------------------------------------------------------------------
            */
            $table->boolean('show_logo')->default(true);
            $table->boolean('show_signature')->default(true);
            $table->boolean('show_seal')->default(true);
            $table->boolean('show_qr')->default(true);
            $table->boolean('show_watermark')->default(true);
            $table->boolean('show_hologram')->default(false);
            $table->boolean('show_certificate_id')->default(true);
            $table->boolean('show_issue_date')->default(true);
            $table->boolean('show_platform_stamp')->default(true);
            $table->boolean('show_course_hours')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Layout
            |--------------------------------------------------------------------------
            */

            $table->enum('orientation', [
                'landscape',
                'portrait'
            ])->default('landscape');

            $table->enum('paper_size', [
                'A4',
                'Letter'
            ])->default('A4');

            $table->integer('margin_top')->default(40);
            $table->integer('margin_bottom')->default(40);
            $table->integer('margin_left')->default(40);
            $table->integer('margin_right')->default(40);

            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            $table->string('verification_url')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_frames');
    }
};
