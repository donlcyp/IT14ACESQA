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
        if (!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->cascadeOnDelete();
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
                $table->string('invoice_number')->unique();
                $table->string('purchase_order_number')->nullable();
                $table->decimal('total_amount', 12, 2)->default(0);
                $table->decimal('amount', 12, 2)->default(0);
                $table->enum('payment_status', ['paid', 'unpaid', 'partial', 'Pending'])->default('unpaid');
                $table->enum('approval_status', ['approved', 'pending'])->default('pending')->index();
                $table->date('invoice_date')->nullable();
                $table->date('verification_date')->nullable();
                $table->date('payment_date')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
