<?php

namespace App\Ship\Database\Casts;

use JBZoo\Data\JSON as JsonData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * Class JSON
 *
 * @package App\Ship\Database\Casts
 */
class JSON implements CastsAttributes
{

    /**
     * Transform the attribute from the underlying model values.
     *
     * @param   Model $model
     * @param   string $key
     * @param   mixed $value
     * @param   array $attributes
     *
     * @return  JsonData
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new JsonData($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
    }
}
