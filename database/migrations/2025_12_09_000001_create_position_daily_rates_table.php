<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('position_daily_rates', function (Blueprint $table) {
            $table->id();
            $table->string('position')->unique();
            $table->decimal('daily_rate', 10, 2);
            $table->text('description')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Insert default rates
        DB::table('position_daily_rates')->insert([
            [
                'position' => 'Project Manager',
                'daily_rate' => 3000.00,
                'description' => 'Manages project planning, execution, and delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Site Supervisor',
                'daily_rate' => 1200.00,
                'description' => 'Oversees on-site construction activities',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Finance Manager',
                'daily_rate' => 1200.00,
                'description' => 'Handles financial planning and budgeting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Quality Assurance Officer',
                'daily_rate' => 1100.00,
                'description' => 'Ensures quality standards are met',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'HR/Timekeeper',
                'daily_rate' => 750.00,
                'description' => 'Manages attendance and employee records',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Construction Worker',
                'daily_rate' => 700.00,
                'description' => 'General construction labor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_daily_rates');
    }
};
