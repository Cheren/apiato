<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Middlewares\Http\RedirectIfAuthenticated;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @package App\Containers\AppSection\Authentication\Providers
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{
    /**
     * Middleware group map.
     *
     * @var array
     */
    protected array $middlewareGroups = [
        'web' => [
            // ..
        ],
        'api' => [
            // ..
        ],
    ];

    /**
     * Middleware map.
     *
     * @var array
     */
    protected array $middlewares = [
        // ..
    ];

    /**
     * Middleware route.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        // apiato User Authentication middleware for Web Pages
        'guest' => RedirectIfAuthenticated::class
    ];
}
