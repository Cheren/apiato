<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

/**
 * Class WebLogoutAction
 *
 * @package App\Containers\AppSection\Authentication\Actions
 */
class WebLogoutAction extends Action
{
    /**
     * Run action.
     */
    public function run(): void
    {
        Auth::logout();
    }
}
