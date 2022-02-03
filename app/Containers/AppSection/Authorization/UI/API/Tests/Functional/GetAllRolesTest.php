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
 * Class GetAllRolesTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class GetAllRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testGetAllRoles(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertTrue(count($responseContent->data) > 0);
    }
}
