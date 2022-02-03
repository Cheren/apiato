<?php

namespace App\Containers\AppSection\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Exceptions\CoreInternalErrorException;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;

/**
 * Class GetAllUsersAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class GetAllUsersAction extends Action
{
    /**
     * Run action.
     *
     * @return mixed
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     */
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->ordered()->run();
    }
}
