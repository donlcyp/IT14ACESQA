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
            $table->boolean('replacement_requested')->default(false)->after('needs_replacement');
            $table->timestamp('replacement_requested_at')->nullable()->after('replacement_requested');
            $table->unsignedBigInteger('replacement_requested_by')->nullable()->after('replacement_requested_at');
            $table->text('replacement_reason')->nullable()->after('replacement_requested_by');
            $table->enum('replacement_status', ['pending', 'approved', 'rejected'])->nullable()->after('replacement_reason');
            $table->timestamp('replacement_approved_at')->nullable()->after('replacement_status');
            $table->unsignedBigInteger('replacement_approved_by')->nullable()->after('replacement_approved_at');
            $table->text('replacement_notes')->nullable()->after('replacement_approved_by');
            
            $table->foreign('replacement_requested_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('replacement_approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['replacement_requested_by']);
            $table->dropForeign(['replacement_approved_by']);
            $table->dropColumn([
                'replacement_requested',
                'replacement_requested_at',
                'replacement_requested_by',
                'replacement_reason',
                'replacement_status',
                'replacement_approved_at',
                'replacement_approved_by',
                'replacement_notes',
            ]);
        });
    }
};
