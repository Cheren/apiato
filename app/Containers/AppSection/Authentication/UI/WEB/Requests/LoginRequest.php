<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class LoginRequest
 *
 * @package App\Containers\AppSection\Authentication\UI\WEB\Requests
 */
class LoginRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'password' => 'required|min:3|max:30',
        ];

        $rules = loginAttributeValidationRulesMerger($rules);

        return $rules;
    }
}
