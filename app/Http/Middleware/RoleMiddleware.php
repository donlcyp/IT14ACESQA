<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Allowed roles can be provided as a comma-separated string in the middleware parameter.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        if (!$user) {
            abort(401);
        }

        // Support both multiple params (role:OWNER,QA becomes ["OWNER","QA"]) and embedded commas
        $allowed = collect($roles)
            ->flatMap(fn ($r) => explode(',', $r))
            ->map(fn ($r) => strtoupper(trim($r)))
            ->filter()
            ->values()
            ->all();

        if (empty($allowed)) {
            return $next($request);
        }

        $userRole = strtoupper(trim((string) $user->role));

        if (!in_array($userRole, $allowed, true)) {
            abort(403);
        }

        return $next($request);
    }
}
