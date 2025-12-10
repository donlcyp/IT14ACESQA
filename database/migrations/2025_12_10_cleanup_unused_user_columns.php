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
        Schema::table('users', function (Blueprint $table) {
            // Drop user_position (redundant with employee_list.position)
            if (Schema::hasColumn('users', 'user_position')) {
                $table->dropColumn('user_position');
            }

            // Drop status (not used in authentication logic)
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'user_position')) {
                $table->string('user_position')->nullable()->after('role');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('Active')->after('user_position');
            }
        });
    }
};
