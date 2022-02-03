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

namespace App\Ship\Parents\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;

/**
 * Class UserModel
 *
 * @package App\Ship\Parents\Models
 */
abstract class UserModel extends AbstractUserModel
{
    use Notifiable;
    use HasApiTokens;
}
