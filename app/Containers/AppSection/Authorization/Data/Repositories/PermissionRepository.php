<?php

namespace App\Containers\AppSection\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class PermissionRepository
 *
 * @package App\Containers\AppSection\Authorization\Data\Repositories
 */
class PermissionRepository extends Repository
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
        return config('permission.models.permission');
    }
}
