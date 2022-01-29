<?php

/**
 * @apiGroup           Country
 * @apiName            createCountry
 *
 * @api                {POST} /v1/countries Endpoint title here..
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

use Illuminate\Support\Facades\Route;
use App\Containers\Locations\Country\UI\API\Controllers\Controller;

Route::post('countries', [Controller::class, 'createCountry'])
    ->name('api_country_create_country')
    ->middleware(['auth:api']);

