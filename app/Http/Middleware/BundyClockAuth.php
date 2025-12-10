<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bundy Clock Security Middleware
 * 
 * This middleware protects bundy clock API endpoints by:
 * 1. IP Whitelist - Only allow requests from specific IPs
 * 2. API Token - Require bearer token authentication
 * 
 * Enable this middleware in routes/web.php by adding:
 * ->middleware('bundy-clock-auth')
 */
class BundyClockAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Option 1: IP Whitelist
        if (config('bundy-clock.use_ip_whitelist', false)) {
            $allowedIPs = config('bundy-clock.allowed_ips', []);
            
            if (!empty($allowedIPs) && !in_array($request->ip(), $allowedIPs)) {
                Log::warning('Bundy Clock: Unauthorized IP attempted access', [
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized IP address',
                ], 403);
            }
        }

        // Option 2: API Token Authentication
        if (config('bundy-clock.use_api_token', false)) {
            $expectedToken = config('bundy-clock.api_token');
            $providedToken = $request->bearerToken();

            if (empty($providedToken) || $providedToken !== $expectedToken) {
                Log::warning('Bundy Clock: Invalid or missing API token', [
                    'ip' => $request->ip(),
                    'has_token' => !empty($providedToken),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or missing API token',
                ], 401);
            }
        }

        // Log successful authentication
        Log::info('Bundy Clock: Request authenticated', [
            'ip' => $request->ip(),
            'endpoint' => $request->path(),
        ]);

        return $next($request);
    }
}
