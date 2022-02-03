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

namespace App\Containers\AppSection\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

/**
 * Class WebLogoutAction
 *
 * @package App\Containers\AppSection\Authentication\Actions
 */
class WebLogoutAction extends Action
{
    /**
     * Run action.
     */
    public function run(): void
    {
        Auth::logout();
    }
}
