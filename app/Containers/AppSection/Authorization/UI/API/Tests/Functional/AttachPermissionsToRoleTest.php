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

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class AttachPermissionsToRoleTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class AttachPermissionsToRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/attach';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testAttachSinglePermissionToRole(): void
    {
        $roleA = Role::factory()->create();
        $permissionA = Permission::factory()->create();
        $data = [
            'role_id' => $roleA->getHashedKey(),
            'permissions_ids' => $permissionA->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($roleA['name'], $responseContent->data->name);
        $this->assertDatabaseHas(config('permission.table_names.role_has_permissions'), [
            'permission_id' => $permissionA->id,
            'role_id' => $roleA->id
        ]);
    }

    public function testAttachMultiplePermissionToRole(): void
    {
        $roleA = Role::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $data = [
            'role_id' => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $this->assertDatabaseHas(config('permission.table_names.role_has_permissions'), [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id' => $roleA->id
        ]);
    }
}
