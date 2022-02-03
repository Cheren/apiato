<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\AuthProvider as AbstractAuthProvider;

/**
 * Class AuthProvider
 *
 * This class is provided by Laravel as default provider, to register authorization policies.
 *
 * @package App\Ship\Parents\Providers
 */
class AuthProvider extends AbstractAuthProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
