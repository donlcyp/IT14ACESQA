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
        if (!Schema::hasTable('proj_mat_manage')) {
            Schema::create('proj_mat_manage', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('project_id')->nullable();
                $table->unsignedBigInteger('client_id')->nullable();
                $table->unsignedBigInteger('employee_id')->nullable();
                $table->string('color')->nullable()->default('#1e40af');
                $table->timestamps();

                // Add foreign keys
                $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
                $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
                $table->foreign('employee_id')->references('id')->on('employee_list')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proj_mat_manage');
    }
};
