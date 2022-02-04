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
use App\Containers\AppSection\User\Traits\IsOwnerTrait;

/**
 * Class DeleteUserRequest
 *
 * @package App\Containers\AppSection\User\UI\API\Requests
 */
class DeleteUserRequest extends Request
{
    use IsOwnerTrait;

    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'delete-users',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'id',
    ];

    /**
     * Authorize.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess|isOwner',
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
            'id' => 'required|exists:users,id',
        ];
    }
}
