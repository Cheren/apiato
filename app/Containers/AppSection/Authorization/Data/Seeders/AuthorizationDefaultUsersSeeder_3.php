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

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;

// @codingStandardsIgnoreStart

/**
 * Class AuthorizationDefaultUsersSeeder_3
 *
 * @package App\Containers\AppSection\Authorization\Data\Seeders
 */
class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    /**
     * Run action.
     *
     * @throws  CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $admin = app(CreateUserByCredentialsTask::class)->run(
            true,
            'admin@admin.com',
            'admin',
            'Super Admin'
        );

        $admin->assignRole(app(FindRoleTask::class)->run('admin'));
        $admin->email_verified_at = now();
        $admin->save();
    }
}
