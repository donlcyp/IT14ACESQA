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
        Schema::table('materials', function (Blueprint $table) {
            // QA Inspection Fields
            if (!Schema::hasColumn('materials', 'qa_status')) {
                $table->string('qa_status')->default('pending')->after('status'); // pending, passed, failed, requires_recheck
            }
            if (!Schema::hasColumn('materials', 'qa_inspected_by')) {
                $table->foreignId('qa_inspected_by')->nullable()->after('qa_status')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('materials', 'qa_inspected_at')) {
                $table->timestamp('qa_inspected_at')->nullable()->after('qa_inspected_by');
            }
            if (!Schema::hasColumn('materials', 'qa_remarks')) {
                $table->text('qa_remarks')->nullable()->after('qa_inspected_at');
            }
            if (!Schema::hasColumn('materials', 'qa_rating')) {
                $table->tinyInteger('qa_rating')->nullable()->after('qa_remarks'); // 1-5 rating
            }
            if (!Schema::hasColumn('materials', 'qa_checklist')) {
                $table->json('qa_checklist')->nullable()->after('qa_rating'); // JSON checklist items
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropConstrainedForeignId('qa_inspected_by');
            $table->dropColumn(['qa_status', 'qa_inspected_at', 'qa_remarks', 'qa_rating', 'qa_checklist']);
        });
    }
};
