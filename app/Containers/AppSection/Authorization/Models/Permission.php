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

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\FactoryLocatorTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 *
 * @property   int     $id
 * @property   string  $name
 * @property   string  $guard_name
 * @property   string  $display_name
 * @property   string  $description
 * @property   string  $created_at
 * @property   string  $updated_at
 *
 * @package App\Containers\AppSection\Authorization\Models
 */
class Permission extends SpatiePermission
{
    use HashIdTrait;
    use HasResourceKeyTrait;
    use HasFactory, FactoryLocatorTrait {
        FactoryLocatorTrait::newFactory insteadof HasFactory;
    }

    /**
     * Guard name.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];
}
