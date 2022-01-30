<?php

namespace App\Containers\Locations\Country\Models;

use JBZoo\Data\JSON as JsonData;
use App\Ship\Database\Casts\JSON;
use App\Ship\Parents\Models\Model;

/**
 * Class Country
 *
 * @property-read int       $id
 * @property-read string    $name
 * @property-read JsonData  $params
 *
 * @package App\Containers\Locations\Country\Models
 */
class Country extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'params'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'params' => JSON::class
    ];

    /**
     * A resource key to be used in the serialized responses.
     *
     * @var string
     */
    protected string $resourceKey = 'Country';
}
