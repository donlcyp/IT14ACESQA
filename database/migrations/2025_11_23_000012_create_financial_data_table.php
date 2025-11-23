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
        if (!Schema::hasTable('financial_data')) {
            Schema::create('financial_data', function (Blueprint $table) {
                $table->id();
                $table->integer('year');
                $table->integer('month');
                $table->decimal('revenue', 15, 2)->default(0);
                $table->decimal('expenses', 15, 2)->default(0);
                $table->timestamps();
                
                // Add unique constraint for year-month combination
                $table->unique(['year', 'month']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_data');
    }
};
