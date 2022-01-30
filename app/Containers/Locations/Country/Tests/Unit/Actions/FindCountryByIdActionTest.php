<?php

namespace App\Containers\Locations\Country\Tests\Unit\Actions;

use Illuminate\Support\Facades\App;
use App\Ship\Parents\Requests\Request;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Locations\Country\Tests\TestCase;
use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tasks\CreateCountryTask;
use App\Containers\Locations\Country\Actions\FindCountryByIdAction;

/**
 * Class FindCountryByIdActionTest
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Actions
 */
class FindCountryByIdActionTest extends TestCase
{

    protected array $data = [
        'name' => 'My country',
        'params' => ['key' => 'value']
    ];

    public function testFailFind()
    {
        $request = new FindCountryByIdActionTestRequest(['id' => 1234]);
        $this->expectException(NotFoundException::class);
        $this->getAction()->run($request);
    }

    public function testSuccessFind()
    {
        /** @var CreateCountryTask $createTask */
        $createTask = App::make(CreateCountryTask::class);
        $country = $createTask->run($this->data);

        $this->assertInstanceOf(Country::class, $country);

        $result = $this->getAction()->run(new FindCountryByIdActionTestRequest([
            'id' => $country->id
        ]));

        $this->assertInstanceOf(Country::class, $result);
    }

    private function getAction(): FindCountryByIdAction
    {
        return App::make(FindCountryByIdAction::class);
    }
}

class FindCountryByIdActionTestRequest extends Request
{
}