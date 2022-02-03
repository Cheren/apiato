<?php

namespace App\Containers\AppSection\User\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;

/**
 * Class CreateAdminAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class CreateAdminAction extends Action
{
    /**
     * Run action.
     *
     * @param   CreateAdminRequest $request
     *
     * @return  User
     *
     * @throws  CreateResourceFailedException
     */
    public function run(CreateAdminRequest $request): User
    {
        $admin = app(CreateUserByCredentialsTask::class)->run(
            true,
            $request->email,
            $request->password,
            $request->name
        );

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_admin=true`).
        app(AssignUserToRoleTask::class)->run($admin, ['admin']);

        return $admin;
    }
}
