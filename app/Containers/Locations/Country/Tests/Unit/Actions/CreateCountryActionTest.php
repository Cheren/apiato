<?php

namespace App\Containers\Locations\Country\Tests\Unit\Actions;

use JBZoo\Data\JSON;
use Illuminate\Support\Facades\App;
use App\Containers\Locations\Country\Tests\TestCase;
use App\Containers\Locations\Country\Models\Country;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Requests\Request as AbstractRequest;
use App\Containers\Locations\Country\Actions\CreateCountryAction;

/**
 * Class CreateCountryActionTest
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Actions
 */
class CreateCountryActionTest extends TestCase
{

    public function testOnFailed(): void
    {
        $request = new Request();

        $this->expectException(CreateResourceFailedException::class);
        App::make(CreateCountryAction::class)->run($request);
    }

    public function testOnSuccess(): void
    {
        $request = $this->getRequest();

        /** @var Country $country */
        $country = App::make(CreateCountryAction::class)->run($request);

        $this->assertInstanceOf(Country::class, $country);
        $this->assertSame('My country', $country->name);
        $this->assertInstanceOf(JSON::class, $country->params);
        $this->assertSame('value', $country->params->get('key'));
    }

    public function testOnUniqueName(): void
    {
        $request = $this->getRequest();

        /** @var Country $country */
        $country = App::make(CreateCountryAction::class)->run($request);
        $this->assertInstanceOf(Country::class, $country);

        $this->expectException(CreateResourceFailedException::class);
        App::make(CreateCountryAction::class)->run($request);
    }

    protected function getRequest(array $data = []): Request
    {
        $data = array_replace_recursive([
            'name' => 'My country',
            'params' => ['key' => 'value']
        ], $data);

        return new Request($data);
    }
}

/**
 * Class Request
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Actions
 */
class Request extends AbstractRequest
{
}
