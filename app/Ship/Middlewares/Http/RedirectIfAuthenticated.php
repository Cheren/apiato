<?php

namespace App\Ship\Middlewares\Http;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Providers\RoutesProvider;

/**
 * Class RedirectIfAuthenticated
 *
 * @package App\Ship\Middlewares\Http
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param   Request $request
     * @param   Closure $next
     * @param   string|null ...$guards
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RoutesProvider::HOME);
            }
        }

        return $next($request);
    }
}
