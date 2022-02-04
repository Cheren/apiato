<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

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
