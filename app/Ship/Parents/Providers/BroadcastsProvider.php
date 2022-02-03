<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

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
