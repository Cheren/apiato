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
 * @apiName            updateUser
 * @api                {patch} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  [password]
 * @apiParam           {String}  [name]
 * @apiParam           {String="male,female,unspecified"}  [gender]
 * @apiParam           {String}  [birth] format: Ymd / e.g. 20151015
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}', [Controller::class, 'updateUser'])
    ->name('api_user_update_user')
    ->middleware(['auth:api']);
