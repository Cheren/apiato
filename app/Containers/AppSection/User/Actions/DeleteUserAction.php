<?php

namespace App\Containers\AppSection\User\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;

/**
 * Class DeleteUserAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class DeleteUserAction extends Action
{
    /**
     * Run action.
     *
     * @param   DeleteUserRequest $request
     *
     * @throws  NotFoundException
     * @throws  DeleteResourceFailedException
     */
    public function run(DeleteUserRequest $request): void
    {
        $user = $request->id
            ? app(FindUserByIdTask::class)->run($request->id)
            : app(GetAuthenticatedUserTask::class)->run();

        app(DeleteUserTask::class)->run($user);
    }
}
