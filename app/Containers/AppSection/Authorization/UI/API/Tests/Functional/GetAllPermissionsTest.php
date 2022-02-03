<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class GetAllPermissionsTest
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Tests\Functional
 */
class GetAllPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testGetAllPermissions(): void
    {
        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertTrue(count($responseContent->data) > 0);
    }
}
