<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class GetAuthenticatedUserTask
 *
 * @package App\Containers\AppSection\Authentication\Tasks
 */
class GetAuthenticatedUserTask extends Task
{
    /**
     * Run action.
     *
     * @return Authenticatable|null
     */
    public function run(): ?Authenticatable
    {
        return Auth::user();
    }
}
