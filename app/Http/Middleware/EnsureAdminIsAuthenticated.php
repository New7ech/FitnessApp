<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsAuthenticated
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! (bool) $request->session()->get('admin_authenticated', false)) {
            return redirect()
                ->route('admin.login')
                ->with('status', 'Connectez-vous pour acceder a l administration.');
        }

        return $next($request);
    }
}
