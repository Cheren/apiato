<?php

/**
 * @apiGroup           User
 * @apiName            FindUserById
 * @api                {get} /v1/users/:id Find User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'delete-users', 'roles' => ''] | Resource Owner
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\FindUserByIdController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}', [FindUserByIdController::class, 'findUserById'])
    ->middleware(['auth:api']);
