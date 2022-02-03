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

use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class CreateRoleTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class CreateRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testCreateRole(): void
    {
        $data = [
            'name' => 'manager',
            'display_name' => 'manager',
            'description' => 'he manages things',
            'level' => 7,
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($data['name'], $responseContent->data->name);
        self::assertEquals($data['level'], $responseContent->data->level);
    }

    public function testCreateRoleWithoutLevel(): void
    {
        $data = [
            'name' => 'manager',
            'display_name' => 'manager',
            'description' => 'he manages things',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals(0, $responseContent->data->level);
    }

    public function testCreateRoleWithWrongName(): void
    {
        $data = [
            'name' => 'include Space',
            'display_name' => 'manager',
            'description' => 'he manages things',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }
}
