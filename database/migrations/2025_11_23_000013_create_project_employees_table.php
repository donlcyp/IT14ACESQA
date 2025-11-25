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
        Schema::create('project_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employee_list')->cascadeOnDelete();
            $table->string('role_title')->nullable();
            $table->decimal('salary', 12, 2)->nullable();
            $table->text('justification')->nullable();
            $table->date('assigned_from')->nullable();
            $table->date('assigned_to')->nullable();
            $table->timestamps();
            
            // Composite unique key to prevent duplicate assignments
            $table->unique(['project_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_employees');
    }
};
