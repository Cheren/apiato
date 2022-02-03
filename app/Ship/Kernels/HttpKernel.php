<?php

namespace App\Ship\Kernels;

use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\Authorize;
use App\Ship\Middlewares\Http\TrimStrings;
use App\Ship\Middlewares\Http\Authenticate;
use App\Ship\Middlewares\Http\TrustProxies;
use App\Ship\Middlewares\Http\EncryptCookies;
use App\Ship\Middlewares\Http\VerifyCsrfToken;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use App\Ship\Middlewares\Http\ProfilerMiddleware;
use App\Ship\Middlewares\Http\ValidateJsonContent;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;
use App\Ship\Middlewares\Http\ProcessETagHeadersMiddleware;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Ship\Middlewares\Http\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

/**
 * Class HttpKernel
 *
 * @package App\Ship\Kernels
 */
class HttpKernel extends LaravelHttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel middleware's
        // \App\Http\Middleware\TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
//             \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            // Note: The "throttle" Middleware is registered by the RoutesLoaderTrait in the Core
            SubstituteBindings::class,
            ValidateJsonContent::class,
            ProcessETagHeadersMiddleware::class,
            ProfilerMiddleware::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        // 'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => SetCacheHeaders::class,
        // Note: The "can" Middleware is registered by MiddlewareServiceProvider in Authorization Container
        // 'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // Note: The "guest" Middleware is registered by MiddlewareServiceProvider in Authentication Container
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * Forces non-global middleware to always be in the given order.
     *
     * @var string[]
     */
    protected $middlewarePriority = [
        EncryptCookies::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        Authenticate::class,
        ThrottleRequests::class,
        AuthenticateSession::class,
        SubstituteBindings::class,
        Authorize::class,
    ];
}
