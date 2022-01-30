<?php

namespace App\Containers\Locations\Country\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Locations\Country\Models\Country;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\Locations\Country\Tasks\UpdateCountryTask;

/**
 * Class UpdateCountryAction
 *
 * @package App\Containers\Locations\Country\Actions
 */
class UpdateCountryAction extends Action
{

    /**
     * Run update country action.
     *
     * @param   Request $request
     *
     * @return  Country
     *
     * @throws  UpdateResourceFailedException
     */
    public function run(Request $request): Country
    {
        $data = $request->sanitizeInput(['name', 'params']);
        return app(UpdateCountryTask::class)->run($request->id, $data);
    }
}
