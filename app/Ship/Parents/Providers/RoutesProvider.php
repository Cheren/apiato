<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\RoutesProvider as AbstractRoutesProvider;

/**
 * Class RoutesProvider
 *
 * @package App\Ship\Parents\Providers
 */
class RoutesProvider extends AbstractRoutesProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
