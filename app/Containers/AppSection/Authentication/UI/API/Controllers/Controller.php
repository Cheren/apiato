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

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use App\Ship\Parents\Controllers\ApiController;
use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Actions\ProxyLoginForWebClientAction;
use App\Containers\AppSection\Authentication\Actions\ProxyRefreshForWebClientAction;
use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;

/**
 * Class Controller
 *
 * @package App\Containers\AppSection\Authentication\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * Logout action.
     *
     * @param   LogoutRequest $request
     *
     * @return  JsonResponse
     */
    public function logout(LogoutRequest $request): JsonResponse
    {
        app(ApiLogoutAction::class)->run($request);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }

    /**
     * This `proxyLoginForWebClient` exist only because we have `WebClient`
     *
     * The more clients (Web Apps).
     *
     * Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @param   ProxyLoginPasswordGrantRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  LoginFailedException
     * @throws  UserNotConfirmedException
     */
    public function proxyLoginForWebClient(ProxyLoginPasswordGrantRequest $request): JsonResponse
    {
        $result = app(ProxyLoginForWebClientAction::class)->run($request);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

    /**
     * Read the comment in the function `proxyLoginForWebClient`
     *
     * @param   ProxyRefreshRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  LoginFailedException
     * @throws  RefreshTokenMissedException
     */
    public function proxyRefreshForWebClient(ProxyRefreshRequest $request): JsonResponse
    {
        $result = app(ProxyRefreshForWebClientAction::class)->run($request);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
