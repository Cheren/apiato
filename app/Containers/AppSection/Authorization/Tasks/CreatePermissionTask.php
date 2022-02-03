<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;

/**
 * Class CreatePermissionTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class CreatePermissionTask extends Task
{
    /**
     * Hold repository.
     *
     * @var PermissionRepository
     */
    protected PermissionRepository $repository;

    /**
     * CreatePermissionTask constructor.
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
     * @param   string $name
     * @param   string|null $description
     * @param   string|null $displayName
     *
     * @return  Permission
     *
     * @throws  CreateResourceFailedException
     */
    public function run(string $name, string $description = null, string $displayName = null): Permission
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $permission = $this->repository->create([
                'name' => $name,
                'description' => $description,
                'display_name' => $displayName,
                'guard_name' => 'web',
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }

        return $permission;
    }
}
