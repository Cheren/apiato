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
 * Class GetAllUsersRequest
 *
 * @package App\Containers\AppSection\User\UI\API\Requests
 */
class GetAllUsersRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'list-users',
        'roles' => 'admin',
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

        ];
    }
}
