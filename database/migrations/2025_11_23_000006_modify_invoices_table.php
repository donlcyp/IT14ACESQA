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
        Schema::table('invoices', function (Blueprint $table) {
            // Add purchase_order_id foreign key if not exists
            if (!Schema::hasColumn('invoices', 'purchase_order_id')) {
                $table->foreignId('purchase_order_id')->nullable()->after('id')->constrained('purchase_orders')->cascadeOnDelete();
            }

            // Add invoice_date if not exists
            if (!Schema::hasColumn('invoices', 'invoice_date')) {
                $table->date('invoice_date')->nullable();
            }

            // Add amount if not exists
            if (!Schema::hasColumn('invoices', 'amount')) {
                $table->decimal('amount', 12, 2)->default(0);
            }

            // Add payment_status if not exists
            if (!Schema::hasColumn('invoices', 'payment_status')) {
                $table->string('payment_status')->default('Pending');
            }

            // Add verification_date if not exists
            if (!Schema::hasColumn('invoices', 'verification_date')) {
                $table->date('verification_date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $columns = ['purchase_order_id', 'amount', 'payment_status', 'verification_date'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('invoices', $column)) {
                    try {
                        $table->dropForeign(['purchase_order_id']);
                    } catch (\Exception $e) {
                        // Constraint might not exist
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
