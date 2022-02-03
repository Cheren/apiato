<?php

namespace App\Containers\AppSection\User\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class DeleteUserTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class DeleteUserTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * DeleteUserTask constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run action.
     *
     * @param   User $user
     *
     * @return  int|null
     *
     * @throws DeleteResourceFailedException
     */
    public function run(User $user): ?int
    {
        try {
            return $this->repository->delete($user->id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
