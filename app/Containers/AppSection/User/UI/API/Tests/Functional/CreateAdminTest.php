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
 * Class CreateAdminTest
 *
 * @package App\Containers\AppSection\User\UI\API\Tests\Functional
 */
class CreateAdminTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/admins';

    protected array $access = [
        'permissions' => 'create-admins',
        'roles' => '',
    ];

    public function testCreateAdmin(): void
    {
        $data = [
            'email' => 'apiato@admin.test',
            'name' => 'admin',
            'password' => 'secret',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name' => $data['name'],
        ]);

        $this->assertResponseContainKeys(['id']);
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $user = User::where(['email' => $data['email']])->first();
        self::assertEquals(true, $user->is_admin);
    }
}
