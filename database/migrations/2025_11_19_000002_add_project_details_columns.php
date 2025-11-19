<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'scope')) {
                $table->text('scope')->nullable()->after('project_name');
            }
            if (!Schema::hasColumn('projects', 'duration_days')) {
                $table->unsignedInteger('duration_days')->nullable()->after('scope');
            }
            if (!Schema::hasColumn('projects', 'start_date')) {
                $table->date('start_date')->nullable()->after('duration_days');
            }
            if (!Schema::hasColumn('projects', 'completed_date')) {
                $table->date('completed_date')->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('projects', 'pm_salary')) {
                $table->decimal('pm_salary', 12, 2)->nullable()->after('lead');
            }
            if (!Schema::hasColumn('projects', 'owner_share')) {
                $table->decimal('owner_share', 12, 2)->nullable()->after('pm_salary');
            }
            if (!Schema::hasColumn('projects', 'pm_confirmed_at')) {
                $table->timestamp('pm_confirmed_at')->nullable()->after('owner_share');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            foreach (['pm_confirmed_at','owner_share','pm_salary','completed_date','start_date','duration_days','scope'] as $col) {
                if (Schema::hasColumn('projects', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
