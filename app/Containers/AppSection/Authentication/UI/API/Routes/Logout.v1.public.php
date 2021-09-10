<?php
/**
 * @apiGroup           OAuth2
 * @apiName            Logout
 * @api                {DELETE} /v1/logout Logout
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
 * {
 * "message": "Token revoked successfully."
 * }
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::delete('logout', [LogoutController::class, 'logout'])
    ->name('api_authentication_logout')
    ->middleware(['auth:api']);

