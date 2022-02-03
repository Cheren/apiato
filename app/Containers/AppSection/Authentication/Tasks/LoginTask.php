<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginTask
 *
 * @package App\Containers\AppSection\Authentication\Tasks
 */
class LoginTask extends Task
{
    /**
     * Run action.
     *
     * @param   string $username
     * @param   string $password
     * @param   string $field
     * @param   bool $remember
     *
     * @return  bool
     */
    public function run(string $username, string $password, string $field = 'email', bool $remember = false): bool
    {
        return Auth::attempt([$field => $username, 'password' => $password], $remember);
    }
}
