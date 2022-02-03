<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;

// @codingStandardsIgnoreStart

/**
 * Class AuthorizationRolesSeeder_2
 *
 * @package App\Containers\AppSection\Authorization\Data\Seeders
 */
class AuthorizationRolesSeeder_2 extends Seeder
{
    /**
     * Run action.
     *
     * @throws  CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Roles ----------------------------------------------------------------
        app(CreateRoleTask::class)->run(
            'admin',
            'Administrator',
            'Administrator Role',
            999
        );
    }
}
