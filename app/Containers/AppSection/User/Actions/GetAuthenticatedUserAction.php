<?php

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
