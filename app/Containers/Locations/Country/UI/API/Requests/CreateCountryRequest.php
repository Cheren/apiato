<?php

namespace App\Containers\Locations\Country\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateCountryRequest
 *
 * @package App\Containers\Locations\Country\UI\API\Requests
 */
class CreateCountryRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @return  array
     */
    protected array $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @return  array
     */
    protected array $decode = [
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @return  array
     */
    protected array $urlParameters = [
        // 'id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules(): array
    {
        return [
            'name'   => config('locations-country.rules.name'),
            'params' => config('locations-country.rules.params')
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
