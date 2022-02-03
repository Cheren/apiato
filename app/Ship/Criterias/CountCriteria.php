<?php

namespace App\Ship\Criterias;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class CountCriteria
 *
 * @package App\Ship\Criterias
 */
class CountCriteria extends Criteria
{
    /**
     * Hold field.
     *
     * @var string
     */
    private string $field;

    /**
     * CountCriteria constructor.
     *
     * @param   $field
     */
    public function __construct($field)
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
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return DB::table($model->getModel()->getTable())
            ->select($this->field, DB::raw('count(' . $this->field . ') as total_count'))
            ->groupBy($this->field);
    }
}
