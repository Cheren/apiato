<?php

namespace App\Containers\Locations\Country\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Exceptions\CreateResourceFailedException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\Locations\Country\Actions\CreateCountryAction;
use App\Containers\Locations\Country\Actions\UpdateCountryAction;
use App\Containers\Locations\Country\Actions\DeleteCountryAction;
use App\Containers\Locations\Country\Actions\FindCountryByIdAction;
use App\Containers\Locations\Country\Actions\GetAllCountriesAction;
use App\Containers\Locations\Country\UI\API\Requests\CreateCountryRequest;
use App\Containers\Locations\Country\UI\API\Requests\DeleteCountryRequest;
use App\Containers\Locations\Country\UI\API\Requests\GetAllCountriesRequest;
use App\Containers\Locations\Country\UI\API\Requests\FindCountryByIdRequest;
use App\Containers\Locations\Country\UI\API\Requests\UpdateCountryRequest;
use App\Containers\Locations\Country\UI\API\Transformers\CountryTransformer;

/**
 * Class Controller
 *
 * @package App\Containers\Locations\Country\UI\API\Controllers
 */
class Controller extends ApiController
{

    /**
     * Action create country.
     *
     * @param   CreateCountryRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  InvalidTransformerException
     * @throws  CreateResourceFailedException
     */
    public function createCountry(CreateCountryRequest $request): JsonResponse
    {
        $country = app(CreateCountryAction::class)->run($request);
        return $this->created($this->transform($country, CountryTransformer::class));
    }

    public function findCountryById(FindCountryByIdRequest $request): array
    {
        $country = app(FindCountryByIdAction::class)->run($request);
        return $this->transform($country, CountryTransformer::class);
    }

    public function getAllCountries(GetAllCountriesRequest $request): array
    {
        $countries = app(GetAllCountriesAction::class)->run($request);
        return $this->transform($countries, CountryTransformer::class);
    }

    /**
     * Action update country.
     *
     * @param   UpdateCountryRequest $request
     *
     * @return  array
     *
     * @throws  InvalidTransformerException
     */
    public function updateCountry(UpdateCountryRequest $request): array
    {
        $country = app(UpdateCountryAction::class)->run($request);
        return $this->transform($country, CountryTransformer::class);
    }

    public function deleteCountry(DeleteCountryRequest $request): JsonResponse
    {
        app(DeleteCountryAction::class)->run($request);
        return $this->noContent();
    }
}
