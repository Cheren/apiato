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

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Mail;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\InternalErrorException;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Containers\AppSection\User\Mails\UserForgotPasswordMail;
use App\Containers\AppSection\User\Tasks\CreatePasswordResetTask;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;

/**
 * Class ForgotPasswordAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class ForgotPasswordAction extends Action
{
    /**
     * Run action.
     *
     * @param   ForgotPasswordRequest $request
     *
     * @throws  NotFoundException
     *
     * @throws  InternalErrorException
     */
    public function run(ForgotPasswordRequest $request): void
    {
        $user = app(FindUserByEmailTask::class)->run($request->email);

        // generate token
        $token = app(CreatePasswordResetTask::class)->run($user);

        // get last segment of the URL
        $resetUrl = $request->reseturl;
        $url = explode('/', $resetUrl);
        $lastSegment = $url[count($url) - 1];

        // validate the allowed endpoint is being used
        if (!in_array($lastSegment, config('appSection-user.allowed-reset-password-urls'), true)) {
            throw new NotFoundException("The URL is not allowed ($resetUrl)");
        }

        // send email
        Mail::send(new UserForgotPasswordMail($user, $token, $resetUrl));
    }
}
