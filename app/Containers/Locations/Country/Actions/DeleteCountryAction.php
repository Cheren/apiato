<?php

namespace App\Containers\Locations\Country\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Containers\Locations\Country\Tasks\DeleteCountryTask;

/**
 * Class DeleteCountryAction
 *
 * @package App\Containers\Locations\Country\Actions
 */
class DeleteCountryAction extends Action
{

    /**
     * Run delete country.
     *
     * @param   Request $request
     *
     * @return  int|null
     *
     * @throws  DeleteResourceFailedException
     */
    public function run(Request $request)
    {
        return app(DeleteCountryTask::class)->run($request->id);
    }
}
