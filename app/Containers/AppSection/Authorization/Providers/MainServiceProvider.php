<?php

namespace App\Containers\AppSection\Authorization\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Spatie\Permission\PermissionServiceProvider;

/**
 * Class MainServiceProvider
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @package App\Containers\AppSection\Authorization\Providers
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        PermissionServiceProvider::class,
        MiddlewareServiceProvider::class
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [

    ];
}
