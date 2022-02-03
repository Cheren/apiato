<?php

namespace App\Containers\AppSection\Authentication\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;

/**
 * Class TokenTransformer
 *
 * @package App\Containers\AppSection\Authentication\UI\API\Transformers
 */
class TokenTransformer extends Transformer
{
    /**
     * Transform for response.
     *
     * @param   $token
     *
     * @return  array
     */
    public function transform($token): array
    {
        $response = [
            'object' => 'Token',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('apiato.api.expires-in'),
        ];

        return $response;
    }
}
