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
use Prettus\Repository\Exceptions\RepositoryException;
use App\Ship\Criterias\OrderByCreationDateDescendingCriteria;
use App\Containers\AppSection\User\Data\Criterias\RoleCriteria;
use App\Containers\AppSection\User\Data\Criterias\AdminsCriteria;
use App\Containers\AppSection\User\Data\Criterias\ClientsCriteria;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class GetAllUsersTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class GetAllUsersTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * GetAllUsersTask constructor.
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
     * @return mixed
     */
    public function run()
    {
        return $this->repository->paginate();
    }

    /**
     * Clients.
     *
     * @return  $this
     *
     * @throws  RepositoryException
     */
    public function clients(): self
    {
        $this->repository->pushCriteria(new ClientsCriteria());
        return $this;
    }

    /**
     * Admins.
     *
     * @return  $this
     *
     * @throws  RepositoryException
     */
    public function admins(): self
    {
        $this->repository->pushCriteria(new AdminsCriteria());
        return $this;
    }

    /**
     * Ordered.
     *
     * @return  $this
     *
     * @throws  RepositoryException
     */
    public function ordered(): self
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this;
    }

    /**
     * With role.
     *
     * @param   $roles
     *
     * @return  $this
     *
     * @throws  RepositoryException
     */
    public function withRole($roles): self
    {
        $this->repository->pushCriteria(new RoleCriteria($roles));
        return $this;
    }
}
