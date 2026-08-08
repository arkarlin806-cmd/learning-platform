<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');

            $table->string('title');

            $table->text('short_description');

            $table->longText('description');

            $table->string('category');

            $table->string('level');

            $table->decimal('price', 10, 2)->default(0);

            $table->string('thumbnail')->nullable();

            $table->string('preview_video')->nullable();

            $table->string('instructor_photo')->nullable();

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};