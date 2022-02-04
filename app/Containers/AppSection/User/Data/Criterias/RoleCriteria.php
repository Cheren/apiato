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

namespace App\Containers\AppSection\User\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class RoleCriteria
 *
 * @package App\Containers\AppSection\User\Data\Criterias
 */
class RoleCriteria extends Criteria
{
    /**
     * Hold role.
     *
     * @var string
     */
    private string $role;

    /**
     * RoleCriteria constructor.
     *
     * @param $role
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Apply criteria in query repository.
     *
     * @param   $model
     * @param   PrettusRepositoryInterface $repository
     *
     * @return  mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas('roles', function ($q) {
            $q->where('name', $this->role);
        });
    }
}
