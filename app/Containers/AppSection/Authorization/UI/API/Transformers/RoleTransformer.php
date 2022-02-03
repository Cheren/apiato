<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use League\Fractal\Resource\Collection;
use App\Ship\Parents\Transformers\Transformer;
use App\Containers\AppSection\Authorization\Models\Role;

/**
 * Class RoleTransformer
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Transformers
 */
class RoleTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'permissions'
    ];

    /**
     * Transform data.
     *
     * @param   Role $role
     *
     * @return  array
     */
    public function transform(Role $role): array
    {
        return [
            'object' => $role->getResourceKey(),
            'id' => $role->getHashedKey(), // << Unique Identifier
            'name' => $role->name, // << Unique Identifier
            'description' => $role->description,
            'display_name' => $role->display_name,
            'level' => $role->level,
        ];
    }

    /**
     * Include permissions.
     *
     * @param   Role $role
     *
     * @return  Collection
     */
    public function includePermissions(Role $role): Collection
    {
        return $this->collection($role->permissions, new PermissionTransformer());
    }
}
