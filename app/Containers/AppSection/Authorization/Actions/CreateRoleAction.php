<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;

/**
 * Class CreateRoleAction
 *
 * @package App\Containers\AppSection\Authorization\Actions
 */
class CreateRoleAction extends Action
{
    /**
     * Run action.
     *
     * @param   CreateRoleRequest $request
     *
     * @return  Role
     *
     * @throws  CreateResourceFailedException
     */
    public function run(CreateRoleRequest $request): Role
    {
        $level = is_null($request->level) ? 0 : $request->level;

        return app(CreateRoleTask::class)->run(
            $request->name,
            $request->description,
            $request->display_name,
            $level
        );
    }
}
