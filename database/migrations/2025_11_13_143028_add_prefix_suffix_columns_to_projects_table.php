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
            if (!Schema::hasColumn('projects', 'client_prefix')) {
                $table->string('client_prefix')->nullable()->after('project_name');
            }

            if (!Schema::hasColumn('projects', 'client_suffix')) {
                $table->string('client_suffix')->nullable()->after('client_last_name');
            }

            if (!Schema::hasColumn('projects', 'lead_prefix')) {
                $table->string('lead_prefix')->nullable()->after('status');
            }

            if (!Schema::hasColumn('projects', 'lead_suffix')) {
                $table->string('lead_suffix')->nullable()->after('lead_last_name');
            }
        });

        DB::table('projects')
            ->select(['id', 'client_name', 'lead', 'client_first_name', 'client_last_name', 'lead_first_name', 'lead_last_name'])
            ->orderBy('id')
            ->each(function ($project) {
                $clientParts = $this->parseName($project->client_name);
                $leadParts = $this->parseName($project->lead);

                if (!$clientParts['first_name']) {
                    $clientParts['first_name'] = $project->client_first_name;
                }

                if (!$clientParts['last_name']) {
                    $clientParts['last_name'] = $project->client_last_name;
                }

                if (!$leadParts['first_name']) {
                    $leadParts['first_name'] = $project->lead_first_name;
                }

                if (!$leadParts['last_name']) {
                    $leadParts['last_name'] = $project->lead_last_name;
                }

                DB::table('projects')
                    ->where('id', $project->id)
                    ->update([
                        'client_prefix' => $clientParts['prefix'],
                        'client_first_name' => $clientParts['first_name'],
                        'client_last_name' => $clientParts['last_name'],
                        'client_suffix' => $clientParts['suffix'],
                        'client_name' => $this->composeName($clientParts, $project->client_name),
                        'lead_prefix' => $leadParts['prefix'],
                        'lead_first_name' => $leadParts['first_name'],
                        'lead_last_name' => $leadParts['last_name'],
                        'lead_suffix' => $leadParts['suffix'],
                        'lead' => $this->composeName($leadParts, $project->lead),
                    ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'client_prefix',
                'client_suffix',
                'lead_prefix',
                'lead_suffix',
            ]);
        });
    }

    /**
     * @return array{prefix:?string,first_name:?string,last_name:?string,suffix:?string}
     */
    private function parseName(?string $name): array
    {
        if (!$name || !is_string($name)) {
            return [
                'prefix' => null,
                'first_name' => null,
                'last_name' => null,
                'suffix' => null,
            ];
        }

        $tokens = array_values(array_filter(preg_split('/\s+/', trim($name)) ?: [], fn ($token) => $token !== ''));

        if (empty($tokens)) {
            return [
                'prefix' => null,
                'first_name' => null,
                'last_name' => null,
                'suffix' => null,
            ];
        }

        $prefixes = [
            'mr', 'mrs', 'ms', 'miss', 'dr', 'engr', 'eng', 'sir', 'madam', 'rev', 'attorney', 'atty', 'eng\'r', 'prof', 'arch', 'architect',
        ];

        $suffixes = [
            'jr', 'sr', 'ii', 'iii', 'iv', 'v', 'phd', 'md', 'dmd', 'pe', 'cpa', 'esq',
        ];

        $prefixTokens = [];
        while (!empty($tokens) && $this->matchesList($tokens[0], $prefixes)) {
            $prefixTokens[] = array_shift($tokens);
        }

        $suffixTokens = [];
        while (!empty($tokens) && $this->matchesList(end($tokens), $suffixes)) {
            array_unshift($suffixTokens, array_pop($tokens));
        }

        $firstName = $tokens[0] ?? null;
        $lastName = null;

        if (count($tokens) > 1) {
            $lastName = implode(' ', array_slice($tokens, 1));
        } elseif (!$firstName && !empty($tokens)) {
            $firstName = implode(' ', $tokens);
        }

        return [
            'prefix' => $this->nullIfEmpty(implode(' ', $prefixTokens)),
            'first_name' => $this->nullIfEmpty($firstName),
            'last_name' => $this->nullIfEmpty($lastName),
            'suffix' => $this->nullIfEmpty(implode(' ', $suffixTokens)),
        ];
    }

    private function matchesList(string $token, array $list): bool
    {
        $normalized = strtolower(trim($token, " \t\n\r\0\x0B.,"));

        return in_array($normalized, $list, true);
    }

    private function nullIfEmpty(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }

    /**
     * @param  array{prefix:?string,first_name:?string,last_name:?string,suffix:?string}  $parts
     */
    private function composeName(array $parts, ?string $fallback): string
    {
        $segments = array_filter([
            $parts['prefix'],
            $parts['first_name'],
            $parts['last_name'],
            $parts['suffix'],
        ], fn ($segment) => $segment !== null && $segment !== '');

        $composed = trim(implode(' ', $segments));

        return $composed !== '' ? $composed : (string) $fallback;
    }
};
