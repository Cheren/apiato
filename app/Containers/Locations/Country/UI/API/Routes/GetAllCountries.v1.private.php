<?php

/**
 * @apiGroup           Country
 * @apiName            getAllCountries
 *
 * @api                {GET} /v1/countries Endpoint title here..
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

Route::get('countries', [Controller::class, 'getAllCountries'])
    ->name('api_country_get_all_countries')
    ->middleware(['auth:api']);

