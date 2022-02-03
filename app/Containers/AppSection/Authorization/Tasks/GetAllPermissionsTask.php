<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;

/**
 * Class GetAllPermissionsTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class GetAllPermissionsTask extends Task
{
    /**
     * Hold repository.
     *
     * @var PermissionRepository
     */
    protected PermissionRepository $repository;

    /**
     * GetAllPermissionsTask constructor.
     *
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run action.
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
