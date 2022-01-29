<?php

/**
 * @apiGroup           Country
 * @apiName            getAllCountries
 *
 * @api                {GET} /v1/countries Get all countries
 * @apiDescription     Get all countries.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
        {
            "object": "Country",
            "id": "NxOpZowo9GmjKqdR",
            "name": "Russia",
            "params": {},
            "real_id": 1
        }
    ],
    "meta": {
        "include": [],
        "custom": [],
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
    }
}
 */

use App\Containers\Locations\Country\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('countries', [Controller::class, 'getAllCountries'])
    ->name('api_country_get_all_countries')
    ->middleware(['auth:api']);

