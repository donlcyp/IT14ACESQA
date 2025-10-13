<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (!Schema::hasColumn('materials', 'qa_record_id')) {
                $table->foreignId('qa_record_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('qa_records')
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (Schema::hasColumn('materials', 'qa_record_id')) {
                $table->dropForeign(['qa_record_id']);
                $table->dropColumn('qa_record_id');
            }
        });
    }
};


