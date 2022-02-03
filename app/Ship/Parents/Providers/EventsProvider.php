<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventsProvider as AbstractEventsProvider;

/**
 * Class EventsProvider
 *
 * A.K.A app/Providers/EventsServiceProvider.php
 *
 * @package App\Ship\Parents\Providers
 */
class EventsProvider extends AbstractEventsProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
