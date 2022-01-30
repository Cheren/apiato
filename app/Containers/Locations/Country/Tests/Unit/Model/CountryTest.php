<?php

namespace App\Containers\Locations\Country\Tests\Unit\Model;

use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tests\TestCase;

/**
 * Class CountryTest
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Model
 */
class CountryTest extends TestCase
{

    protected Country $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new Country();
    }

    public function testModelInstance(): void
    {
        $this->assertInstanceOf(Country::class, $this->model);
    }

    public function testModelTableName(): void
    {
        $this->assertSame(config('locations-country.table.name'), $this->model->getTable());
    }

    public function testTimestamp(): void
    {
        $this->assertFalse($this->model->timestamps);
    }

    public function testGetResourceKey(): void
    {
        $this->assertSame('Country', $this->model->getResourceKey());
    }

    public function testFillable(): void
    {
        $this->assertSame(['name', 'params'], $this->model->getFillable());
    }

    public function testAttributeCastForParams(): void
    {
        $model = new Country([
            'params' => [
                'flag' => 'Russia',
                'currency' => 'RUB',
                'attrs' => [
                    'key' => 'value'
                ]
            ]
        ]);

        $this->assertSame('Russia', $model->params->get('flag'));
        $this->assertSame('default', $model->params->get('no-exists', 'default'));
        $this->assertSame('value', $model->params->find('attrs.key'));
    }
}
