<?php

namespace App\Containers\AppSection\User\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Hash;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\InternalErrorException;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class UpdateUserTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class UpdateUserTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * UpdateUserTask constructor.
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
     * @param   array $userData
     * @param   $userId
     *
     * @return  User
     *
     * @throws  NotFoundException
     * @throws  InternalErrorException
     * @throws  UpdateResourceFailedException
     */
    public function run(array $userData, $userId): User
    {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        try {
            // hash password if exist (before updating user)
            if (array_key_exists('password', $userData)) {
                $userData['password'] = Hash::make($userData['password']);
            }

            $user = $this->repository->update($userData, $userId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('User Not Found.');
        } catch (Exception $exception) {
            throw new InternalErrorException();
        }

        return $user;
    }
}
