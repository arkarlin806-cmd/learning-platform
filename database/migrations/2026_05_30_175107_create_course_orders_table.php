<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('instructor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('order_no')->unique();

            $table->decimal('amount',10,2);

            $table->decimal('admin_amount',10,2);

            $table->decimal('instructor_amount',10,2);

            $table->string('payment_method');

            $table->string('payment_screenshot');

            $table->enum('status',[
                'pending',
                'paid',
                'failed',
                'refund'
            ])->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_orders');
    }
};
