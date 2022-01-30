<?php

namespace App\Containers\Locations\Country\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Exceptions\CoreInternalErrorException;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Containers\Locations\Country\Tasks\GetAllCountriesTask;

/**
 * Class GetAllCountriesAction
 *
 * @package App\Containers\Locations\Country\Actions
 */
class GetAllCountriesAction extends Action
{

    /**
     * Run get all country action.
     *
     * @param   Request $request
     *
     * @return  mixed
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     */
    public function run(Request $request)
    {
        return app(GetAllCountriesTask::class)->addRequestCriteria()->run();
    }
}
