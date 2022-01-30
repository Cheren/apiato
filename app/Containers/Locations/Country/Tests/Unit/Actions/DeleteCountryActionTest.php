<?php

namespace App\Containers\Locations\Country\Tests\Unit\Actions;

use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tasks\CreateCountryTask;
use Illuminate\Support\Facades\App;
use App\Ship\Parents\Requests\Request;
use App\Containers\Locations\Country\Tests\TestCase;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Containers\Locations\Country\Actions\DeleteCountryAction;

class DeleteCountryActionTest extends TestCase
{

    protected array $data = [
        'name' => 'My country',
        'params' => ['key' => 'value']
    ];

    public function testFailDelete()
    {
        $this->expectException(DeleteResourceFailedException::class);
        $this->getAction()->run(new DeleteCountryActionTestRequest());
    }

    public function testSuccessDelete()
    {
        /** @var CreateCountryTask $createTask */
        $createTask = App::make(CreateCountryTask::class);
        $country = $createTask->run($this->data);

        $this->assertInstanceOf(Country::class, $country);
        $result = $this->getAction()->run(new DeleteCountryActionTestRequest(['id' => $country->id]));
        $this->assertSame(1, $result);
    }

    private function getAction(): DeleteCountryAction
    {
        return App::make(DeleteCountryAction::class);
    }
}

class DeleteCountryActionTestRequest extends Request
{
}
