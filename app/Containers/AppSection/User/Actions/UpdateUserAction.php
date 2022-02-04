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
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\InternalErrorException;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;

/**
 * Class UpdateUserAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class UpdateUserAction extends Action
{
    /**
     * Run action.
     *
     * @param   UpdateUserRequest $request
     *
     * @return  User
     *
     * @throws  NotFoundException
     * @throws  InternalErrorException
     * @throws  UpdateResourceFailedException
     */
    public function run(UpdateUserRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'password',
            'name',
            'gender',
            'birth',
            'social_token',
            'social_expires_in',
            'social_refresh_token',
            'social_token_secret'
        ]);

        return app(UpdateUserTask::class)->run($sanitizedData, $request->id);
    }
}
