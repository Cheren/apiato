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

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class UserRepository
 *
 * @package App\Containers\AppSection\User\Data\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Searchable fields.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'id' => '=',
        'email' => '=',
        'email_verified_at' => '=',
        'created_at' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return config('auth.providers.users.model');
    }
}
