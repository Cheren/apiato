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
 * Class FindRoleTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class FindRoleTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testFindRoleById(): void
    {
        $roleA = Role::factory()->create();

        $response = $this->injectId($roleA->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($roleA->name, $responseContent->data->name);
    }
}
