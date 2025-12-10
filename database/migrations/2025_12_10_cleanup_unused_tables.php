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
        // Disable foreign key checks temporarily
        Schema::disableForeignKeyConstraints();

        // Drop proj_mat_manage table (redundant with project-material relationships)
        if (Schema::hasTable('proj_mat_manage')) {
            Schema::dropIfExists('proj_mat_manage');
        }

        // Drop purchase_orders table (unused in current workflow)
        if (Schema::hasTable('purchase_orders')) {
            Schema::dropIfExists('purchase_orders');
        }

        // Drop password_reset_tokens table (using PasswordResetRequest model instead)
        if (Schema::hasTable('password_reset_tokens')) {
            Schema::dropIfExists('password_reset_tokens');
        }

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate if needed (note: this is for rollback only)
        // In practice, these tables were redundant and shouldn't be restored
    }
};
