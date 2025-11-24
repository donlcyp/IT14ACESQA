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
        // Create projects table from scratch
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('project_code')->unique();
                $table->text('description')->nullable();
                $table->string('location')->nullable();
                $table->string('industry')->nullable();
                $table->date('date_started')->nullable();
                $table->date('date_ended')->nullable();
                $table->date('target_timeline')->nullable();
                $table->foreignId('assigned_pm_id')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete();
                $table->decimal('allocated_amount', 15, 2)->default(0);
                $table->decimal('used_amount', 15, 2)->default(0);
                $table->string('status')->default('Ongoing');
                $table->text('note_remarks')->nullable();
                $table->string('pm_status')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
