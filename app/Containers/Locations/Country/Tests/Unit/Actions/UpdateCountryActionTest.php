<?php

namespace App\Containers\Locations\Country\Tests\Unit\Actions;

use Apiato\Core\Traits\HashIdTrait;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\App;
use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tests\TestCase;
use App\Ship\Parents\Requests\Request as AbstractRequest;
use App\Containers\Locations\Country\Tasks\CreateCountryTask;
use App\Containers\Locations\Country\Actions\UpdateCountryAction;

/**
 * Class UpdateCountryActionTest
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Actions
 */
class UpdateCountryActionTest extends TestCase
{

    protected array $data = [
        'name' => 'New Country',
        'params' => [
            'currency' => 'rub'
        ]
    ];

    public function testSuccessUpdate()
    {
        $country = app(CreateCountryTask::class)->run([
            'name' => 'Russia'
        ]);

        $request = new UpdateCountryActionRequest([
            'id' => $country->id,
            'name' => 'USA',
            'params' => [
                'currency' => 'dollar',
                'new-key' => 'New value'
            ]
        ]);

        $this->assertSame('Russia', $country->name);
        $newCountry = $this->getAction()->run($request);

        $this->assertSame('USA', $newCountry->name);
        $this->assertSame('dollar', $newCountry->params->get('currency'));
        $this->assertSame('New value', $newCountry->params->get('new-key'));
    }

    public function testNotFindForUpdate()
    {
        $request = new UpdateCountryActionRequest([
            'id' => 123,
            'name' => 'Ukraine'
        ]);

        $this->expectException(UpdateResourceFailedException::class);
        $this->getAction()->run($request);
    }

    private function getAction(): UpdateCountryAction
    {
        return App::make(UpdateCountryAction::class);
    }
}

class UpdateCountryActionRequest extends AbstractRequest
{
}
