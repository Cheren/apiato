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

use App\Containers\AppSection\User\Tests\ApiTestCase;

/**
 * Class FindUserTest
 *
 * @package App\Containers\AppSection\User\UI\API\Tests\Functional
 */
class FindUserTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'search-users',
    ];

    public function testFindUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($user->name, $responseContent->data->name);
    }

    public function testFindFilteredUserResponse(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        self::assertEquals($user->name, $responseContent->data->name);
        self::assertEquals($user->email, $responseContent->data->email);
        self::assertNotContains('id', json_decode($response->getContent(), true));
    }

    public function testFindUserWithRelation(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($user->email, $responseContent->data->email);
        self::assertNotNull($responseContent->data->roles);
    }
}
