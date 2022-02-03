<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

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
     * @param   Model   $model
     * @param   string  $key
     * @param   mixed   $value
     * @param   array   $attributes
     *
     * @return  string
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  Model    $model
     * @param  string   $key
     * @param  mixed    $value
     * @param  array    $attributes
     *
     * @return JsonData
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return new JsonData($value);
    }
}
