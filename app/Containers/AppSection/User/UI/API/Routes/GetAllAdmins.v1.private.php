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
 * @apiName            getAllAdmins
 * @api                {get} /v1/admins Get All Admin Users
 * @apiDescription     Get All Users where role `Admin`.
 *                     You can search for Users by email, name and ID.
 *                     Example: `?search=Mahmoud` or `?search=whatever@mail.com`.
 *                     You can specify the field as follow `?search=email:whatever@mail.com` or `?search=id:20`.
 *                     You can search by multiple fields as follow: `?search=name:Mahmoud&email:whatever@mail.com`.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('admins', [Controller::class, 'getAllAdmins'])
    ->name('api_user_get_all_admins')
    ->middleware(['auth:api']);
