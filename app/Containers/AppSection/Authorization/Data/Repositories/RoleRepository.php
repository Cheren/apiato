<?php

namespace App\Containers\AppSection\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class RoleRepository
 *
 * @package App\Containers\AppSection\Authorization\Data\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Field searchable.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    /**
     * This function relies on strict conventions.
     *
     * @return string
     */
    public function model(): string
    {
        return config('permission.models.role');
    }
}
