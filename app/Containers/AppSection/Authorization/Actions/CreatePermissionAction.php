<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

namespace App\Containers\AppSection\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;

/**
 * Class CreatePermissionAction
 *
 * @package App\Containers\AppSection\Authorization\Actions
 */
class CreatePermissionAction extends Action
{
    /**
     * Run action.
     *
     * @param   Request $request
     *
     * @return  Permission
     *
     * @throws  CreateResourceFailedException
     */
    public function run(Request $request): Permission
    {
        return app(CreatePermissionTask::class)->run(
            $request->name,
            $request->description,
            $request->display_name
        );
    }
}
