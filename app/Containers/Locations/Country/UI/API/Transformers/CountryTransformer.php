<?php

namespace App\Containers\Locations\Country\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;
use App\Containers\Locations\Country\Models\Country;

/**
 * Class CountryTransformer
 *
 * @package App\Containers\Locations\Country\UI\API\Transformers
 */
class CountryTransformer extends Transformer
{

    /**
     * Include resources without needing it to be requested.
     *
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * Resources that can be included if requested.
     *
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * Transform data.
     *
     * @param   Country $country
     *
     * @return  array
     */
    public function transform(Country $country): array
    {
        $response = [
            'object' => $country->getResourceKey(),
            'id'     => $country->getHashedKey(),
            'name'   => $country->name,
            'params' => $country->params
        ];

        return $response = $this->ifAdmin([
            'real_id' => $country->id,
        ], $response);
    }
}
