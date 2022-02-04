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

namespace App\Containers\AppSection\User\Actions;

use Illuminate\Support\Str;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Exceptions\InternalErrorException;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;

/**
 * Class ResetPasswordAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class ResetPasswordAction extends Action
{
    /**
     * Run action.
     *
     * @param   ResetPasswordRequest $request
     *
     * @throws  InternalErrorException
     */
    public function run(ResetPasswordRequest $request): void
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'token',
            'password'
        ]);

        $sanitizedData['password_confirmation'] = $request->password;

        try {
            Password::broker()->reset(
                $sanitizedData,
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
