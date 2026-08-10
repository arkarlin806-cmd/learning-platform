<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'current_streak')) {
                $table->unsignedInteger('current_streak')->default(0);
            }

            if (!Schema::hasColumn('users', 'last_login_date')) {
                $table->date('last_login_date')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'current_streak')) {
                $table->dropColumn('current_streak');
            }

            if (Schema::hasColumn('users', 'last_login_date')) {
                $table->dropColumn('last_login_date');
            }
        });
    }
};
