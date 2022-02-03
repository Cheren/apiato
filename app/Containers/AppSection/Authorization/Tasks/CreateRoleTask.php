<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;

/**
 * Class CreateRoleTask
 *
 * @package App\Containers\AppSection\Authorization\Tasks
 */
class CreateRoleTask extends Task
{
    /**
     * Hold repository.
     *
     * @var RoleRepository
     */
    protected RoleRepository $repository;

    /**
     * CreateRoleTask constructor.
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
     * @param   string $name
     * @param   string|null $description
     * @param   string|null $displayName
     * @param   int $level
     *
     * @return  Role
     *
     * @throws  CreateResourceFailedException
     */
    public function run(string $name, string $description = null, string $displayName = null, int $level = 0): Role
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $role = $this->repository->create([
                'name' => strtolower($name),
                'description' => $description,
                'display_name' => $displayName,
                'guard_name' => 'web',
                'level' => $level,
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }

        return $role;
    }
}
