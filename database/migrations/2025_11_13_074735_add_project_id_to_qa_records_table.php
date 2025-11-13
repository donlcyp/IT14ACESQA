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
        $tableName = Schema::hasTable('qa_records') ? 'qa_records' : 'project_records';

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (!Schema::hasColumn($tableName, 'project_id')) {
                $table->foreignId('project_id')
                    ->nullable()
                    ->unique()
                    ->constrained('projects')
                    ->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableName = Schema::hasTable('project_records') ? 'project_records' : 'qa_records';

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (Schema::hasColumn($tableName, 'project_id')) {
                $table->dropConstrainedForeignId('project_id');
            }
        });
    }
};
