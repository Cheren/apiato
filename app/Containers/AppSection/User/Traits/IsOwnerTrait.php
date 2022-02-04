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

namespace App\Containers\AppSection\User\Traits;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;

/**
 * Trait IsOwnerTrait
 *
 * @package App\Containers\AppSection\User\Traits
 */
trait IsOwnerTrait
{
    /**
     * Check if the submitted ID (mainly URL ID's) is the same as
     * the authenticated user ID (based on the user Token).
     */
    public function isOwner(): bool
    {
        $user = app(GetAuthenticatedUserTask::class)->run();
        return $user->id === $this->id;
    }
}
