<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            // Link material to a specific QA record/project
            $table->foreignId('project_record_id')->nullable()->constrained('project_records')->cascadeOnDelete();
            $table->string('name');
            $table->string('batch')->nullable();
            $table->string('supplier')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('unit')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->date('date_received')->nullable();
            $table->date('date_inspected')->nullable();
            $table->string('status')->default('Pending');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
