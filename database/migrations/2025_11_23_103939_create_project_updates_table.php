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
        Schema::create('project_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['Ongoing', 'Completed', 'On Hold', 'Cancelled', 'In Progress'])->default('Ongoing');
            $table->timestamps();

            // Indexes
            $table->index('project_id');
            $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_updates');
    }
};
