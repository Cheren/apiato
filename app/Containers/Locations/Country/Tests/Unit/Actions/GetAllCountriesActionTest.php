<?php

namespace App\Containers\Locations\Country\Tests\Unit\Actions;

use Illuminate\Support\Facades\App;
use App\Ship\Parents\Requests\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Containers\Locations\Country\Tests\TestCase;
use App\Containers\Locations\Country\Actions\GetAllCountriesAction;

/**
 * Class GetAllCountriesActionTest
 *
 * @package App\Containers\Locations\Country\Tests\Unit\Actions
 */
class GetAllCountriesActionTest extends TestCase
{

    public function testGetAll()
    {
        $result = $this->getAction()->run(new GetAllCountriesActionTestRequest());
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    private function getAction(): GetAllCountriesAction
    {
        return App::make(GetAllCountriesAction::class);
    }
}

class GetAllCountriesActionTestRequest extends Request
{
}
