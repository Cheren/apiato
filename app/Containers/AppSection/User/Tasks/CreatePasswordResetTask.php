<?php

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
