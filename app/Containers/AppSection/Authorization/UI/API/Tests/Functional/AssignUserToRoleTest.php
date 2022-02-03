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
 * Class AssignUserToRoleTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class AssignUserToRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/assign?include=roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testAssignUserToRole(): void
    {
        $randomUser = User::factory()->create();
        $role = Role::factory()->create();
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($data['user_id'], $responseContent->data->id);
        self::assertEquals($data['roles_ids'][0], $responseContent->data->roles->data[0]->id);
    }

    public function testAssignUserToManyRoles(): void
    {
        $randomUser = User::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
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
