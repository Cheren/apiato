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

namespace App\Containers\AppSection\User\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;

// @codingStandardsIgnoreStart

/**
 * Class UserPermissionsSeeder_1
 *
 * @package App\Containers\AppSection\User\Data\Seeders
 */
class UserPermissionsSeeder_1 extends Seeder
{
    /**
     * Run action.
     *
     * @throws  CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Permissions ----------------------------------------------------------
        $createPermissionTask = app(CreatePermissionTask::class);
        $createPermissionTask->run('search-users', 'Find a User in the DB.');
        $createPermissionTask->run('list-users', 'Get All Users.');
        $createPermissionTask->run('update-users', 'Update a User.');
        $createPermissionTask->run('delete-users', 'Delete a User.');
        $createPermissionTask->run('refresh-users', 'Refresh User data.');
    }
}
