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
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class DeleteRoleTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class DeleteRoleTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testDeleteExistingRole(): void
    {
        $role = Role::factory()->create();

        $response = $this->injectId($role->id)->makeCall();

        $response->assertStatus(204);
    }
}
