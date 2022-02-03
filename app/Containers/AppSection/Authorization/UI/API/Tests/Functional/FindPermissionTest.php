<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class FindPermissionTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class FindPermissionTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testFindPermissionById(): void
    {
        $permissionA = Permission::factory()->create();

        $response = $this->injectId($permissionA->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($permissionA->name, $responseContent->data->name);
    }
}
