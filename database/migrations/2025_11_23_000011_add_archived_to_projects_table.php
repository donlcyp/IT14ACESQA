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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'archived')) {
                $table->boolean('archived')->default(false)->after('pm_status');
            }
            if (!Schema::hasColumn('projects', 'archived_at')) {
                $table->timestamp('archived_at')->nullable()->after('archived');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'archived')) {
                $table->dropColumn('archived');
            }
            if (Schema::hasColumn('projects', 'archived_at')) {
                $table->dropColumn('archived_at');
            }
        });
    }
};
