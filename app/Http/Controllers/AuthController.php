<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Log login activity for OWNER role
            $user = Auth::user();
            if ($user && $user->role === 'OWNER') {
                Log::create([
                    'user_id' => $user->id,
                    'action' => 'LOGIN',
                    'log_date' => now(),
                    'details' => json_encode([
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'timestamp' => now()->toDateTimeString(),
                    ]),
                ]);
            }
            
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        // Log logout activity for OWNER role
        if ($user && $user->role === 'OWNER') {
            Log::create([
                'user_id' => $user->id,
                'action' => 'LOGOUT',
                'log_date' => now(),
                'details' => json_encode([
                    'ip_address' => $request->ip(),
                    'session_duration' => session('login_time') ? now()->diffInSeconds(session('login_time')) : null,
                    'timestamp' => now()->toDateTimeString(),
                ]),
            ]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
