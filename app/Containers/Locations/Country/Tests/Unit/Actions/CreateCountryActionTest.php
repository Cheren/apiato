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

    protected array $data = [
        'name' => 'My country',
        'params' => ['key' => 'value']
    ];

    public function testOnFailed(): void
    {
        $request = new CreateCountryActionRequest();

        $this->expectException(CreateResourceFailedException::class);
        $this->getAction()->run($request);
    }

    public function testOnSuccess(): void
    {
        $request = $this->getRequest();

        /** @var Country $country */
        $country = $this->getAction()->run($request);

        $this->assertInstanceOf(Country::class, $country);
        $this->assertSame($this->data['name'], $country->name);
        $this->assertInstanceOf(JSON::class, $country->params);
        $this->assertSame('value', $country->params->get('key'));
    }

    public function testOnUniqueName(): void
    {
        $request = $this->getRequest();

        /** @var Country $country */
        $country = $this->getAction()->run($request);
        $this->assertInstanceOf(Country::class, $country);

        $this->expectException(CreateResourceFailedException::class);
        $this->getAction()->run($request);
    }

    private function getAction()
    {
        return App::make(CreateCountryAction::class);
    }

    private function getRequest(array $data = []): CreateCountryActionRequest
    {
        return new CreateCountryActionRequest($this->getData($data));
    }
}

class CreateCountryActionRequest extends AbstractRequest
{
}
