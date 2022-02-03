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

namespace App\Containers\AppSection\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;

/**
 * Class WebLoginAction
 *
 * @package App\Containers\AppSection\Authentication\Actions
 */
class WebLoginAction extends Action
{
    /**
     * Run action.
     *
     * @param   LoginRequest $request
     *
     * @return  User|Authenticatable|null
     *
     * @throws  LoginFailedException
     * @throws  UserNotConfirmedException
     */
    public function run(LoginRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => true
        ]);

        $loginCustomAttribute = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);

        $isSuccessful = app(LoginTask::class)->run(
            $loginCustomAttribute['username'],
            $sanitizedData['password'],
            $loginCustomAttribute['loginAttribute'],
            $sanitizedData['remember_me']
        );

        $user = null;
        if ($isSuccessful) {
            $user = Auth::user();
        } else {
            throw new LoginFailedException();
        }

        $isUserConfirmed = app(CheckIfUserEmailIsConfirmedTask::class)->run($user);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
