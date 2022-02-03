<?php

namespace App\Containers\AppSection\User\Models;

use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;

/**
 * Class User
 *
 * @property   int     $id
 * @property   string  $name
 * @property   string  $email
 * @property   string  $password
 * @property   string  $email_verified_at
 * @property   string  $gender
 * @property   string  $birth
 * @property   string  $device
 * @property   string  $platform
 * @property   bool    $is_admin
 * @property   string  $remember_token
 * @property   string  $created_at
 * @property   string  $updated_at
 *
 * @package App\Containers\AppSection\User\Models
 */
class User extends UserModel
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'device',
        'platform',
        'gender',
        'birth',
        'social_provider',
        'social_token',
        'social_refresh_token',
        'social_expires_in',
        'social_token_secret',
        'social_id',
        'social_avatar',
        'social_avatar_original',
        'social_nickname',
        'email_verified_at',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];
}
