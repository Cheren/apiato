<?php

namespace App\Containers\Locations\Country\Actions;

use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tasks\UpdateCountryTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateCountryAction extends Action
{
    public function run(Request $request): Country
    {
        $data = $request->sanitizeInput(['name', 'params']);
        return app(UpdateCountryTask::class)->run($request->id, $data);
    }
}
