<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;

/**
 * Class AttachPermissionsToRoleAction
 *
 * @package App\Containers\AppSection\Authorization\Actions
 */
class AttachPermissionsToRoleAction extends Action
{
    /**
     * Run action.
     *
     * @param   AttachPermissionToRoleRequest $request
     *
     * @return  Role
     */
    public function run(AttachPermissionToRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        // convert to array in case single ID was passed
        $permissionIds = (array) $request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionIds);

        return $role->givePermissionTo($permissions);
    }
}
