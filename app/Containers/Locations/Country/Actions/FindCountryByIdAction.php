<?php

namespace App\Containers\Locations\Country\Actions;

use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tasks\FindCountryByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindCountryByIdAction extends Action
{
    public function run(Request $request): Country
    {
        return app(FindCountryByIdTask::class)->run($request->id);
    }
}
