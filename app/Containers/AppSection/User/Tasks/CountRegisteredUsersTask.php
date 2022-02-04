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

use App\Ship\Parents\Tasks\Task;
use App\Ship\Criterias\NotNullCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class CountRegisteredUsersTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class CountRegisteredUsersTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * CountRegisteredUsersTask constructor.
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
     * @return  int
     *
     * @throws  RepositoryException
     */
    public function run(): int
    {
        $this->repository->pushCriteria(new NotNullCriteria('email'));
        return $this->repository->all()->count();
    }
}
