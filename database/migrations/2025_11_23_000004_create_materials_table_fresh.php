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
        if (!Schema::hasTable('materials')) {
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('material_name');
                $table->string('batch_serial_no')->nullable();
                $table->string('supplier')->nullable();
                $table->integer('quantity_received')->default(0);
                $table->string('unit_of_measure')->nullable();
                $table->decimal('unit_price', 10, 2)->default(0);
                $table->decimal('total_cost', 12, 2)->default(0);
                $table->date('date_received')->nullable();
                $table->date('date_inspected')->nullable();
                $table->string('status')->default('Pending');
                $table->text('remarks')->nullable();
                $table->string('location')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
