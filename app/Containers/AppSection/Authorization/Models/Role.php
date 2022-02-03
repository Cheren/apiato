<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Apiato\Core\Traits\FactoryLocatorTrait;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 *
 * @property   int     $id
 * @property   string  $name
 * @property   string  $guard_name
 * @property   string  $display_name
 * @property   string  $description
 * @property   string  $created_at
 * @property   string  $updated_at
 * @property   int     $level
 *
 * @package App\Containers\AppSection\Authorization\Models
 */
class Role extends SpatieRole
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
        'level',
    ];
}
