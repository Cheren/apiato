<?php

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
