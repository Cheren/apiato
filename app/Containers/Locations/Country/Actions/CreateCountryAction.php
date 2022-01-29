<?php

namespace App\Containers\Locations\Country\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Locations\Country\Models\Country;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\Locations\Country\Tasks\CreateCountryTask;

/**
 * Class CreateCountryAction
 *
 * @package App\Containers\Locations\Country\Actions
 */
class CreateCountryAction extends Action
{

    /**
     * Run action.
     *
     * @param   Request $request
     *
     * @return  Country
     *
     * @throws  CreateResourceFailedException
     */
    public function run(Request $request): Country
    {
        $data = $request->sanitizeInput(['name', 'params']);
        return app(CreateCountryTask::class)->run($data);
    }
}
