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

namespace App\Containers\AppSection\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Exceptions\CoreInternalErrorException;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;

/**
 * Class GetAllClientsAction
 *
 * @package App\Containers\AppSection\User\Actions
 */
class GetAllClientsAction extends Action
{
    /**
     * Run action.
     *
     * @return  mixed
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     */
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->clients()->ordered()->run();
    }
}
