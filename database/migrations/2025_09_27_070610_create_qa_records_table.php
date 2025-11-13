<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_records', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('client');
            $table->string('inspector');
            $table->string('time'); // Using string for "30 mins ago"; could use timestamp
            $table->string('color'); // For picture background color
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_records');
    }
};