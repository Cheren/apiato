<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Illuminate\Support\Str;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;

/**
 * Class FindRoleTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class FindRoleTask extends Task
{
    /**
     * Hold repository.
     *
     * @var RoleRepository
     */
    protected RoleRepository $repository;

    /**
     * FindRoleTask constructor.
     *
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run action.
     *
     * @param   $roleNameOrId
     *
     * @return  Role
     */
    public function run($roleNameOrId): Role
    {
        $query = (is_numeric($roleNameOrId) || Str::isUuid($roleNameOrId))
            ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];

        return $this->repository->findWhere($query)->first();
    }
}
