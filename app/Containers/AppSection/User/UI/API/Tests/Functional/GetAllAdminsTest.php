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
 * Class GetAllAdminsTest
 *
 * @package App\Containers\AppSection\User\UI\API\Tests\Functional
 */
class GetAllAdminsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/admins';

    protected array $access = [
        'roles' => '',
        'permissions' => 'list-users',
    ];

    public function testGetAllAdmins(): void
    {
        User::factory()->count(1)->create();
        User::factory()->count(1)->admin()->create();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        // 1 + 1 (seeded super admin)
        self::assertCount(2, $responseContent->data);
    }

    public function testGetAllAdminsByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(403);
        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }
}
