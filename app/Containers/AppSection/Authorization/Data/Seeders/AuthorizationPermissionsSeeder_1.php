<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;

// @codingStandardsIgnoreStart

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @package App\Containers\AppSection\Authorization\Data\Seeders
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
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

        $createPermissionTask->run(
            'manage-roles',
            'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.'
        );

        $createPermissionTask->run('create-admins', 'Create new Users (Admins) from the dashboard.');
        $createPermissionTask->run('manage-admins-access', 'Assign users to Roles.');
        $createPermissionTask->run('access-dashboard', 'Access the admins dashboard.');
    }
}
