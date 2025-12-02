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
            // Add BOQ-specific fields if they don't exist
            if (!Schema::hasColumn('materials', 'item_no')) {
                $table->integer('item_no')->nullable()->after('id');
            }
            if (!Schema::hasColumn('materials', 'material_cost')) {
                $table->decimal('material_cost', 12, 2)->nullable()->default(0)->after('unit_rate');
            }
            if (!Schema::hasColumn('materials', 'labor_cost')) {
                $table->decimal('labor_cost', 12, 2)->nullable()->default(0)->after('material_cost');
            }
            if (!Schema::hasColumn('materials', 'unit_total')) {
                $table->decimal('unit_total', 12, 2)->nullable()->default(0)->after('labor_cost');
            }
            if (!Schema::hasColumn('materials', 'item_total')) {
                $table->decimal('item_total', 12, 2)->nullable()->default(0)->after('unit_total');
            }
            if (!Schema::hasColumn('materials', 'notes')) {
                $table->text('notes')->nullable()->after('remarks');
            }
            if (!Schema::hasColumn('materials', 'category')) {
                $table->string('category')->nullable()->after('item_no');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn([
                'item_no',
                'category',
                'material_cost',
                'labor_cost',
                'unit_total',
                'item_total',
                'notes',
            ]);
        });
    }
};
