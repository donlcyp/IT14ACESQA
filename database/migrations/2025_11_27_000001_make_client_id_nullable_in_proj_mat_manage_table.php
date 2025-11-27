<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only modify if column exists
        if (Schema::hasColumn('proj_mat_manage', 'client_id')) {
            try {
                Schema::table('proj_mat_manage', function (Blueprint $table) {
                    // Make client_id nullable using raw SQL to avoid issues
                    DB::statement('ALTER TABLE proj_mat_manage MODIFY client_id BIGINT UNSIGNED NULL');
                });
            } catch (QueryException $e) {
                // If foreign key constraint fails, we'll drop and recreate
                if (strpos($e->getMessage(), 'foreign key') !== false) {
                    DB::statement('ALTER TABLE proj_mat_manage DROP FOREIGN KEY proj_mat_manage_client_id_foreign');
                    DB::statement('ALTER TABLE proj_mat_manage MODIFY client_id BIGINT UNSIGNED NULL');
                    DB::statement('ALTER TABLE proj_mat_manage ADD CONSTRAINT proj_mat_manage_client_id_foreign FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE');
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('proj_mat_manage', 'client_id')) {
            try {
                DB::statement('ALTER TABLE proj_mat_manage MODIFY client_id BIGINT UNSIGNED NOT NULL');
            } catch (QueryException $e) {
                // Silently fail on reverse
            }
        }
    }
};
