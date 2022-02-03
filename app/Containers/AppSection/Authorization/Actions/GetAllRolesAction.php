<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;

/**
 * Class GetAllRolesAction
 *
 * @package App\Containers\AppSection\Authorization\Actions
 */
class GetAllRolesAction extends Action
{
    /**
     * Run action.
     *
     * @return mixed
     */
    public function run()
    {
        return app(GetAllRolesTask::class)->run();
    }
}
