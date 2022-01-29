<?php

/**
 * @apiGroup           Country
 * @apiName            findCountryById
 *
 * @api                {GET} /v1/countries/:id Endpoint title here..
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

Route::get('countries/{id}', [Controller::class, 'findCountryById'])
    ->name('api_country_find_country_by_id')
    ->middleware(['auth:api']);

