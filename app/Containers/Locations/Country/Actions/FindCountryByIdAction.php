<?php

namespace App\Containers\Locations\Country\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Locations\Country\Models\Country;
use App\Containers\Locations\Country\Tasks\FindCountryByIdTask;

/**
 * Class FindCountryByIdAction
 *
 * @package App\Containers\Locations\Country\Actions
 */
class FindCountryByIdAction extends Action
{

    /**
     * Run action.
     *
     * @param   Request $request
     *
     * @return  Country
     *
     * @throws  NotFoundException
     */
    public function run(Request $request): Country
    {
        return app(FindCountryByIdTask::class)->run($request->id);
    }
}
