<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Ship\Parents\Controllers\WebController;
use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;

/**
 * Class Controller
 *
 * @package App\Containers\AppSection\Authentication\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * Action login.
     *
     * @param   LoginRequest $request
     *
     * @return  RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $result = app(WebLoginAction::class)->run($request);
        } catch (Exception $e) {
            return redirect()
                ->route(config('appSection-authentication.login-page-url'))
                ->with('status', $e->getMessage());
        }

        return is_array($result)
            ? redirect()->route(config('appSection-authentication.login-page-url'))->with($result)
            : redirect()->intended();
    }

    /**
     * Action logout.
     *
     * @param   LogoutRequest $request
     *
     * @return  RedirectResponse|Redirector
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function logout(LogoutRequest $request)
    {
        app(WebLogoutAction::class)->run();
        return redirect('/');
    }

    /**
     * Action how login page.
     *
     * @return Factory|View
     */
    public function showLoginPage()
    {
        return view('appSection@authentication::login');
    }
}
