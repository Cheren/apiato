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

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;

/**
 * Class LoginTest
 *
 * @group authentication
 * @group unit
 *
 * @package App\Containers\AppSection\Authentication\Tests\Unit
 */
class LoginTest extends TestCase
{
    private array $userDetails;
    private LoginRequest $request;
    private $action;

    public function setUp(): void
    {
        parent::setUp();
        $this->userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];
        $this->getTestingUser($this->userDetails);
        $this->actingAs($this->testingUser, 'web');
        $this->request = new LoginRequest($this->userDetails);
        $this->action = App::make(WebLoginAction::class);
    }

    public function testLogin(): void
    {
        $user = $this->action->run($this->request);

        self::assertInstanceOf(User::class, $user);
        self::assertSame($user->name, $this->userDetails['name']);
    }

    public function testLoginWithInvalidCredentialsThrowsAnException(): void
    {
        $this->expectException(LoginFailedException::class);

        $this->request = new LoginRequest(['email' => 'wrong@email.com', 'password' => 'wrong_password']);

        $this->action->run($this->request);
    }

    public function testGivenEmailConfirmationIsRequiredAndUserIsNotConfirmedThrowsAnException(): void
    {
        $this->expectException(UserNotConfirmedException::class);

        $configInitialValue = config('appSection-authentication.require_email_confirmation');
        Config::set('appSection-authentication.require_email_confirmation', true);
        $this->testingUser->email_verified_at = null;
        $this->testingUser->save();

        $this->action->run($this->request);

        Config::set('appSection-authentication.require_email_confirmation', $configInitialValue);
    }
}
