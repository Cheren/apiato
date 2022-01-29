<?php

namespace App\Containers\Locations\Country\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class CountryRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
