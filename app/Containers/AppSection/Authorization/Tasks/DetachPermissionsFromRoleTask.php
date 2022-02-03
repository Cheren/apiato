<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Models\Role;

/**
 * Class DetachPermissionsFromRoleTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class DetachPermissionsFromRoleTask extends Task
{
    /**
     * Run action.
     *
     * @param   Role $role
     * @param   $singleOrMultiplePermissionIds
     *
     * @return  Role
     */
    public function run(Role $role, $singleOrMultiplePermissionIds): Role
    {
        if (!is_array($singleOrMultiplePermissionIds)) {
            $singleOrMultiplePermissionIds = [$singleOrMultiplePermissionIds];
        }

        // remove each permission ID found in the array from that role.
        array_map(static function ($permissionId) use ($role) {
            $permission = app(FindPermissionTask::class)->run($permissionId);
            $role->revokePermissionTo($permission);
        }, $singleOrMultiplePermissionIds);

        return $role;
    }
}
