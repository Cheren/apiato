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
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Notification;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\User\Mails\UserRegisteredMail;
use App\Containers\AppSection\User\Events\UserRegisteredEvent;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\Notifications\UserRegisteredNotification;

/**
 * Class RegisterUserAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class RegisterUserAction extends Action
{
    /**
     * Run action.
     *
     * @param   RegisterUserRequest $request
     *
     * @return  User
     *
     * @throws  CreateResourceFailedException
     */
    public function run(RegisterUserRequest $request): User
    {
        $user = app(CreateUserByCredentialsTask::class)->run(
            false,
            $request->email,
            $request->password,
            $request->name,
            $request->gender,
            $request->birth
        );

        Mail::send(new UserRegisteredMail($user));
        Notification::send($user, new UserRegisteredNotification($user));
        app(Dispatcher::class)->dispatch(new UserRegisteredEvent($user));

        return $user;
    }
}
