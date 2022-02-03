<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;

/**
 * Class GetAllRolesTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class GetAllRolesTask extends Task
{
    /**
     * Hold repository.
     *
     * @var RoleRepository
     */
    protected RoleRepository $repository;

    /**
     * GetAllRolesTask constructor.
     *
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * run action.
     *
     * @param   bool $skipPagination
     *
     * @return  mixed
     */
    public function run(bool $skipPagination = false)
    {
        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }
}
