<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (!Schema::hasColumn('materials', 'project_record_id')) {
                $table->foreignId('project_record_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('project_records')
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (Schema::hasColumn('materials', 'project_record_id')) {
                $table->dropForeign(['project_record_id']);
                $table->dropColumn('project_record_id');
            }
        });
    }
};


