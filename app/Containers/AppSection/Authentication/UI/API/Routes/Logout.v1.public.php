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

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Authentication\UI\API\Controllers\Controller;

Route::delete('logout', [Controller::class, 'logout'])
    ->name('api_authentication_logout')
    ->middleware(['auth:api']);
