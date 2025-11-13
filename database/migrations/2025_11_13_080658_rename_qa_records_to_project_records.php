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
        if (Schema::hasTable('qa_records') && !Schema::hasTable('project_records')) {
            Schema::rename('qa_records', 'project_records');
        }

        if (Schema::hasColumn('materials', 'qa_record_id')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->dropForeign(['qa_record_id']);
            });

            Schema::table('materials', function (Blueprint $table) {
                $table->renameColumn('qa_record_id', 'project_record_id');
            });

            Schema::table('materials', function (Blueprint $table) {
                $table->foreign('project_record_id')
                    ->references('id')
                    ->on('project_records')
                    ->cascadeOnDelete();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('materials', 'project_record_id')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->dropForeign(['project_record_id']);
            });

            Schema::table('materials', function (Blueprint $table) {
                $table->renameColumn('project_record_id', 'qa_record_id');
        });
        }

        if (Schema::hasTable('project_records') && !Schema::hasTable('qa_records')) {
            Schema::rename('project_records', 'qa_records');
        }

        if (Schema::hasColumn('materials', 'qa_record_id')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->foreign('qa_record_id')
                    ->references('id')
                    ->on('qa_records')
                    ->cascadeOnDelete();
            });
        }
    }
};
