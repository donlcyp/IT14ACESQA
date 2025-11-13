<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'client_first_name')) {
                $table->string('client_first_name')->nullable()->after('project_name');
            }

            if (!Schema::hasColumn('projects', 'client_last_name')) {
                $table->string('client_last_name')->nullable()->after('client_first_name');
            }

            if (!Schema::hasColumn('projects', 'lead_first_name')) {
                $table->string('lead_first_name')->nullable()->after('client_last_name');
            }

            if (!Schema::hasColumn('projects', 'lead_last_name')) {
                $table->string('lead_last_name')->nullable()->after('lead_first_name');
            }
        });

        DB::table('projects')
            ->select(['id', 'client_name', 'lead'])
            ->orderBy('id')
            ->each(function ($project) {
                $clientParts = $this->splitName($project->client_name);
                $leadParts = $this->splitName($project->lead);

                DB::table('projects')
                    ->where('id', $project->id)
                    ->update([
                        'client_first_name' => $clientParts['first_name'],
                        'client_last_name' => $clientParts['last_name'],
                        'lead_first_name' => $leadParts['first_name'],
                        'lead_last_name' => $leadParts['last_name'],
                    ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'lead_last_name')) {
                $table->dropColumn('lead_last_name');
            }

            if (Schema::hasColumn('projects', 'lead_first_name')) {
                $table->dropColumn('lead_first_name');
            }

            if (Schema::hasColumn('projects', 'client_last_name')) {
                $table->dropColumn('client_last_name');
            }

            if (Schema::hasColumn('projects', 'client_first_name')) {
                $table->dropColumn('client_first_name');
            }
        });
    }

    /**
     * @param  string|null  $name
     * @return array{first_name:?string,last_name:?string}
     */
    private function splitName(?string $name): array
    {
        if (!$name) {
            return [
                'first_name' => null,
                'last_name' => null,
            ];
        }

        $parts = preg_split('/\s+/', trim($name)) ?: [];

        if (count($parts) === 0) {
            return [
                'first_name' => null,
                'last_name' => null,
            ];
        }

        $first = array_shift($parts);
        $last = count($parts) > 0 ? implode(' ', $parts) : null;

        return [
            'first_name' => $first,
            'last_name' => $last,
        ];
    }
};
