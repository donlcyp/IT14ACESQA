<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('role_title')->nullable();
            $table->decimal('salary', 12, 2)->nullable();
            $table->text('justification')->nullable();
            $table->date('assigned_from')->nullable();
            $table->date('assigned_to')->nullable();
            $table->timestamps();
            $table->unique(['project_id','employee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_employees');
    }
};
