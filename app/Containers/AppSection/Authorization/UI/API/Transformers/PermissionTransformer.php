<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;
use App\Containers\AppSection\Authorization\Models\Permission;

/**
 * Class PermissionTransformer
 *
 * @package App\Containers\AppSection\Authorization\UI\API\Transformers
 */
class PermissionTransformer extends Transformer
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

    ];

    /**
     * Transform data.
     *
     * @param   Permission $permission
     *
     * @return  array
     */
    public function transform(Permission $permission): array
    {
        return [
            'object' => $permission->getResourceKey(),
            'id' => $permission->getHashedKey(), // << Unique Identifier
            'name' => $permission->name, // << Unique Identifier
            'description' => $permission->description,
            'display_name' => $permission->display_name,
        ];
    }
}
