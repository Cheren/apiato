<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class ResetPasswordRequest
 *
 * @package App\Containers\AppSection\User\UI\API\Requests
 */
class ResetPasswordRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'token',
        'email',
        'password',
    ];

    /**
     * Authorize.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }

    /**
     * Rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'token' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ];
    }
}
