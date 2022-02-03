<?php

namespace App\Ship\Criterias;

use Illuminate\Database\Query\Builder;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisEqualThatCriteria
 *
 * @package App\Ship\Criterias
 */
class ThisEqualThatCriteria extends Criteria
{
    /**
     * Hold field.
     *
     * @var string
     */
    private string $field;

    /**
     * Hold value.
     *
     * @var string
     */
    private string $value;

    /**
     * ThisEqualThatCriteria constructor.
     *
     * @param   string $field
     * @param   string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
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
        return $model->where($this->field, $this->value);
    }
}
