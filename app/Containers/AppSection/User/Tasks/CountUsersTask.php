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
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class CountUsersTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class CountUsersTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * CountUsersTask constructor.
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
     * @return int
     */
    public function run(): int
    {
        return $this->repository->all()->count();
    }
}
