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

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use Illuminate\Support\Arr;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class SyncUserRolesTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class SyncUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/sync?include=roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $role1 = Role::factory()->create(['display_name' => '111']);
        $role2 = Role::factory()->create(['display_name' => '222']);
        $randomUser = User::factory()->create();
        $randomUser->assignRole($role1);
        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertTrue(count($responseContent->data->roles->data) > 1);
        $roleIds = Arr::pluck($responseContent->data->roles->data, 'id');
        self::assertContains($data['roles_ids'][0], $roleIds);
        self::assertContains($data['roles_ids'][1], $roleIds);
    }
}
