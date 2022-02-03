<?php

namespace App\Ship\Middlewares\Http;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Ship\Exceptions\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as LaravelAuthenticate;
use Illuminate\Auth\AuthenticationException as BaseAuthenticationException;

/**
 * Class Authenticate
 *
 * @package App\Ship\Middlewares\Http
 */
class Authenticate extends LaravelAuthenticate
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param   Request $request
     * @param   array $guards
     *
     * @throws  AuthenticationException
     * @throws  BaseAuthenticationException
     */
    public function authenticate($request, array $guards): void
    {
        try {
            parent::authenticate($request, $guards);
        } catch (Exception $exception) {
            if ($request->expectsJson()) {
                throw new AuthenticationException();
            } else {
                $this->unauthenticated($request, $guards);
            }
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param   Request $request
     *
     * @return  string|null
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function redirectTo($request): ?string
    {
        return route(Config::get('appSection-authentication.login-page-url'));
    }
}
