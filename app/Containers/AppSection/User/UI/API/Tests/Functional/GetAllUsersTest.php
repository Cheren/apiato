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

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest
 *
 * @package App\Containers\AppSection\User\UI\API\Tests\Functional
 */
class GetAllUsersTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users';

    protected array $access = [
        'roles' => 'admin',
        'permissions' => 'list-users',
    ];

    public function testGetAllUsersByAdmin(): void
    {
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        self::assertCount(4, $responseContent->data);
    }

    public function testGetAllUsersByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(403);
        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }

    public function testSearchUsersByName(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz'
        ]);

        $response = $this->endpoint($this->endpoint . '?search=name:mahmoudzzz')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($user->name, $responseContent->data[0]->name);
        self::assertCount(1, $responseContent->data);
    }
}
