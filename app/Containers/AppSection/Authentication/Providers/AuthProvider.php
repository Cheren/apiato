<?php

namespace App\Containers\AppSection\Authentication\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Apiato\Core\Loaders\RoutesLoaderTrait;
use App\Ship\Parents\Providers\AuthProvider as ParentAuthProvider;

/**
 * Class AuthProvider
 *
 * This class is provided by Laravel as default provider,
 * to register authorization policies.
 *
 * A.K.A App\Providers\AuthServiceProvider.php
 *
 * @package App\Containers\AppSection\Authentication\Providers
 */
class AuthProvider extends ParentAuthProvider
{
    use RoutesLoaderTrait;

    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->registerPassport();
        $this->registerPassportApiRoutes();
        $this->registerPassportWebRoutes();
    }

    /**
     * Register passport.
     */
    private function registerPassport(): void
    {
        if (config('apiato.api.enabled-implicit-grant')) {
            Passport::enableImplicitGrant();
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.expires-in')));

        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.refresh-expires-in')));
    }

    /**
     * Register passport api routes.
     */
    private function registerPassportApiRoutes(): void
    {
        $prefix = config('apiato.api.prefix');
        $routeGroupArray = $this->getRouteGroup("/{$prefix}v1");

        if (!$this->app->routesAreCached()) {
            Route::group($routeGroupArray, function () {
                Passport::routes(function (RouteRegistrar $router) {
                    $router->forAccessTokens();
                    $router->forTransientTokens();
                    $router->forClients();
                    $router->forPersonalAccessTokens();
                });
            });
        }
    }

    /**
     * Register passport web routes.
     */
    private function registerPassportWebRoutes(): void
    {
        if (!$this->app->routesAreCached()) {
            Passport::routes(function (RouteRegistrar $router) {
                $router->forAuthorization();
            });
        }
    }
}
