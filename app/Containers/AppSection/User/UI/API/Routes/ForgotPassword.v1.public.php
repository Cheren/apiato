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
 * @apiName            forgotPassword
 *
 * @api                {POST} /v1/password/forgot Forgot password
 * @apiDescription     Forgot password endpoint.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  reseturl the reset password url
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 OK
 * {}
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('password/forgot', [Controller::class, 'forgotPassword'])
    ->name('api_user_forgot_password');
