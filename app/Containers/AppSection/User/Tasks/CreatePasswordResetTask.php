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

namespace App\Containers\AppSection\User\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Exceptions\Exception;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\InternalErrorException;

/**
 * Class CreatePasswordResetTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class CreatePasswordResetTask extends Task
{
    /**
     * Run action.
     *
     * @param   User $user
     *
     * @return  string
     *
     * @throws  InternalErrorException
     */
    public function run(User $user): string
    {
        try {
            return app('auth.password.broker')->createToken($user);
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
