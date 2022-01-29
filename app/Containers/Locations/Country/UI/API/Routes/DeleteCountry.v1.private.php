<?php

/**
 * @apiGroup           Country
 * @apiName            deleteCountry
 *
 * @api                {DELETE} /v1/countries/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Locations\Country\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('countries/{id}', [Controller::class, 'deleteCountry'])
    ->name('api_country_delete_country')
    ->middleware(['auth:api']);

