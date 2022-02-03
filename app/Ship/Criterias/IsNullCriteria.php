<?php

namespace App\Ship\Criterias;

use Illuminate\Database\Query\Builder;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class IsNullCriteria
 *
 * @package App\Ship\Criterias
 */
class IsNullCriteria extends Criteria
{
    /**
     * Hold field.
     *
     * @var string
     */
    private string $field;

    /**
     * IsNullCriteria constructor.
     *
     * @param   string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

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
        return $model->whereNull($this->field);
    }
}
