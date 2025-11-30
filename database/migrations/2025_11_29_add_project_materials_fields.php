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
            // Add columns if they don't exist
            if (!Schema::hasColumn('materials', 'item_description')) {
                $table->string('item_description')->nullable()->after('material_name');
            }
            if (!Schema::hasColumn('materials', 'unit_rate')) {
                $table->decimal('unit_rate', 10, 2)->nullable()->after('unit_of_measure');
            }
            if (!Schema::hasColumn('materials', 'quantity')) {
                $table->decimal('quantity', 10, 2)->nullable()->after('quantity_received');
            }
            if (!Schema::hasColumn('materials', 'unit')) {
                $table->string('unit')->nullable()->after('unit_of_measure');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['item_description', 'unit_rate', 'quantity', 'unit']);
        });
    }
};
