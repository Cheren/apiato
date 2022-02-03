<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Lcobucci\JWT\Parser;
use App\Ship\Parents\Actions\Action;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;

/**
 * Class ApiLogoutAction
 *
 * @package App\Containers\AppSection\Authentication\Actions
 */
class ApiLogoutAction extends Action
{
    /**
     * Run action.
     *
     * @param LogoutRequest $request
     */
    public function run(LogoutRequest $request): void
    {
        $id = app(Parser::class)->parse($request->bearerToken())->claims()->get('jti');
        app(TokenRepository::class)->revokeAccessToken($id);
        app(RefreshTokenRepository::class)->revokeRefreshTokensByAccessTokenId($id);
    }
}
