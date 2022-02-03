<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Class MakeRefreshCookieTask
 *
 * @package App\Containers\AppSection\Authentication\Tasks
 */
class MakeRefreshCookieTask extends Task
{
    /**
     * Run action.
     *
     * @param   $refreshToken
     *
     * @return  CookieJar|Cookie
     */
    public function run($refreshToken)
    {
        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        return cookie(
            'refreshToken',
            $refreshToken,
            config('apiato.api.refresh-expires-in'),
            null,
            null,
            config('session.secure'),
            true // HttpOnly
        );
    }
}
