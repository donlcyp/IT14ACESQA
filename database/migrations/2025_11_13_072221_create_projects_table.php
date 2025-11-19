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
        if (!Schema::hasTable('projects')) {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
                $table->string('project_name');
                $table->string('client_name');
                $table->string('status')->default('Ongoing');
                $table->string('lead');
            $table->timestamps();
            });
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'project_name')) {
                $table->string('project_name')->after('id');
            }

            if (!Schema::hasColumn('projects', 'client_name')) {
                $table->string('client_name')->after('project_name');
            }

            if (!Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('Ongoing')->after('client_name');
            }

            if (!Schema::hasColumn('projects', 'lead')) {
                $table->string('lead')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
