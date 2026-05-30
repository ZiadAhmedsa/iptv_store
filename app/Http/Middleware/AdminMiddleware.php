<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('admin')->check() && auth('admin')->user()->isAdmin() && auth('admin')->user()->is_active) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'ليس لديك صلاحية الدخول إلى لوحة التحكم.');
    }
}
