<?php

namespace App\Ship\Parents\Providers;

use Illuminate\Support\Facades\Broadcast;
use Apiato\Core\Abstracts\Providers\BroadcastsProvider as AbstractBroadcastsProvider;

/**
 * Class BroadcastsProvider
 *
 * A.K.A app/Providers/BroadcastServiceProvider.php
 *
 * @package App\Ship\Parents\Providers
 */
class BroadcastsProvider extends AbstractBroadcastsProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /** @noinspection PhpIncludeInspection */
        require app_path('Ship/Broadcasts/Routes.php');
    }
}
