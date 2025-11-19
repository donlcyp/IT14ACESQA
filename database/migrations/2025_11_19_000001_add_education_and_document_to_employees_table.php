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
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'education_level')) {
                $table->string('education_level')->nullable()->after('position');
            }
            if (!Schema::hasColumn('employees', 'document_path')) {
                $table->string('document_path')->nullable()->after('education_level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'document_path')) {
                $table->dropColumn('document_path');
            }
            if (Schema::hasColumn('employees', 'education_level')) {
                $table->dropColumn('education_level');
            }
        });
    }
};
