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
            $table->string('failure_reason')->nullable()->after('qa_remarks');
            $table->boolean('needs_replacement')->default(false)->after('failure_reason');
            $table->timestamp('qa_decision_at')->nullable()->after('needs_replacement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['failure_reason', 'needs_replacement', 'qa_decision_at']);
        });
    }
};
