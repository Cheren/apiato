<?php

namespace App\Ship\Traits;

/**
 * Trait DefaultReplacedDataTrait
 *
 * @package App\Ship\Traits
 */
trait DefaultReplacedDataTrait
{

    /**
     * Default data.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Get data.
     *
     * @param array $data
     *
     * @return array
     */
    public function getData(array $data): array
    {
        return array_replace_recursive($this->data, $data);
    }
}
