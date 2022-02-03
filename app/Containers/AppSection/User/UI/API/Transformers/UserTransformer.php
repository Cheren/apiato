<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use League\Fractal\Resource\Collection;
use App\Ship\Parents\Transformers\Transformer;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;

/**
 * Class UserTransformer
 *
 * @package App\Containers\AppSection\User\UI\API\Transformers
 */
class UserTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'roles',
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
     * @param   User $user
     *
     * @return  array
     */
    public function transform(User $user): array
    {
        $response = [
            'object' => $user->getResourceKey(),
            'id' => $user->getHashedKey(),
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'gender' => $user->gender,
            'birth' => $user->birth,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $user->id,
        ], $response);

        return $response;
    }

    /**
     * Include roles.
     *
     * @param   User $user
     *
     * @return  Collection
     */
    public function includeRoles(User $user): Collection
    {
        return $this->collection($user->roles, new RoleTransformer());
    }
}
