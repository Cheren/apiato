<?php

namespace App\Ship\Criterias;

use Illuminate\Database\Query\Builder;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class OrderByUpdateDateDescendingCriteria
 *
 * @package App\Ship\Criterias
 */
class OrderByUpdateDateDescendingCriteria extends Criteria
{
    /**
     * Apply criteria in query repository.
     *
     * @param   $model
     * @param   PrettusRepositoryInterface $repository
     *
     * @return  Builder
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy('updated_at', 'desc');
    }
}
