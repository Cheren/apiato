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

namespace App\Containers\AppSection\User\Tests\Unit;

use Illuminate\Support\Facades\App;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;

/**
 * Class RegisterUserTest
 *
 * @package App\Containers\AppSection\User\Tests\Unit
 */
class RegisterUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];

        $request = new RegisterUserRequest($data);
        $user = App::make(RegisterUserAction::class)->run($request);

        self::assertInstanceOf(User::class, $user);
        self::assertEquals($user->name, $data['name']);
    }
}
