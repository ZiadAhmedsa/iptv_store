<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;

class LogUserSession
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionId = session()->getId();
            
            $userSession = UserSession::where('session_id', $sessionId)
                ->where('status', 'active')
                ->first();

            if (!$userSession) {
                UserSession::create([
                    'user_id' => $user->id,
                    'session_id' => $sessionId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'login_at' => now(),
                    'last_activity_at' => now(),
                    'status' => 'active',
                ]);
            } else {
                $userSession->update([
                    'last_activity_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
