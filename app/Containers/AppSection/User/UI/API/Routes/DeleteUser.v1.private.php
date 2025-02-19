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
 *
 * @apiGroup           User
 * @apiName            deleteUser
 * @api                {delete} /v1/users/:id Delete User
 * @apiDescription     Delete users of any type (Admin, Client...)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "User (4) Deleted Successfully."
 * }
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}', [Controller::class, 'deleteUser'])
    ->name('api_user_delete_user')
    ->middleware(['auth:api']);
