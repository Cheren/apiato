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
