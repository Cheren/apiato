<?php

/**
 * @apiGroup           Country
 * @apiName            createCountry
 *
 * @api                {POST} /v1/countries Create new country
 * @apiDescription     Create new country in application.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String} name Country unique name.
 * @apiParam           {Array} [params] Custom country params as array ($key => $value).
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
        "object": "Country",
        "id": "NxOpZowo9GmjKqdR",   //  Hashed id.
        "name": "Russia",
        "params": {},
        "real_id": 1    // Real id. Only for administrator.
    },
    "meta": {
        "include": [],
        "custom": []
    }
}
 */

use Illuminate\Support\Facades\Route;
use App\Containers\Locations\Country\UI\API\Controllers\Controller;

Route::post('countries', [Controller::class, 'createCountry'])
    ->name('api_country_create_country')
    ->middleware(['auth:api']);

