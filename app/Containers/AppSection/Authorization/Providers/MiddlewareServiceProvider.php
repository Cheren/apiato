<?php

namespace App\Containers\AppSection\Authorization\Providers;

use Illuminate\Auth\Middleware\Authorize;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @package App\Containers\AppSection\Authorization\Providers
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

        ],
        'api' => [

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
     * Middleware route map.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        // Laravel default route middleware's:
        'can' => Authorize::class,
    ];
}
