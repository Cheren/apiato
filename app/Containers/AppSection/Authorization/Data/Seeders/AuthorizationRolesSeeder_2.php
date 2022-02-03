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
