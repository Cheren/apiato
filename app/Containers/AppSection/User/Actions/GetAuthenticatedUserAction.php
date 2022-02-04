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
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;

/**
 * Class GetAuthenticatedUserAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class GetAuthenticatedUserAction extends Action
{
    /**
     * Run action.
     *
     * @return User
     *
     * @throws NotFoundException
     */
    public function run(): User
    {
        $user = app(GetAuthenticatedUserTask::class)->run();

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
