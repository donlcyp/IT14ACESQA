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
        Schema::table('proj_mat_manage', function (Blueprint $table) {
            $table->string('color')->nullable()->default('#16a34a')->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proj_mat_manage', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
