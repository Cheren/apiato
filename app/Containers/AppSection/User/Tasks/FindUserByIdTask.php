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
use App\Ship\Exceptions\NotFoundException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class FindUserByIdTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class FindUserByIdTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * FindUserByIdTask constructor.
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
     * @param   $userId
     *
     * @return  User
     *
     * @throws  NotFoundException
     */
    public function run($userId): User
    {
        try {
            $user = $this->repository->find($userId);
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $user;
    }
}
