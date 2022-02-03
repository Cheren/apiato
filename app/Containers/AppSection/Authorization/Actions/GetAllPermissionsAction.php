<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;

/**
 * Class GetAllPermissionsAction
 *
 * @package App\Containers\AppSection\Authorization\Actions
 */
class GetAllPermissionsAction extends Action
{
    /**
     * Run action.
     *
     * @return mixed
     */
    public function run()
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}
