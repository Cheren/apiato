<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Containers\AppSection\User\Models\User;

/**
 * Class AssignUserToRoleTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class AssignUserToRoleTask extends Task
{
    /**
     * Run action.
     *
     * @param   User $user
     * @param   array $roles
     *
     * @return  Authenticatable
     */
    public function run(User $user, array $roles): Authenticatable
    {
        return $user->assignRole($roles);
    }
}
