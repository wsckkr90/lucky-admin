<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RootLandingMiddleware
{
    /**
     * Handle the landing URL without creating a / -> /login redirect chain.
     *
     * This keeps the root request useful for humans and health/monitoring tools
     * while authenticated admins go directly to the dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('/')) {
            if (Auth::check()) {
                return redirect()->route('admin.dashboard');
            }

            return response()->view('auth.login');
        }

        return $next($request);
    }
}
