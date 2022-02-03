<?php

namespace App\Containers\AppSection\Authorization\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Containers\AppSection\Authorization\Models\Permission;

/**
 * Class PermissionFactory
 *
 * @package App\Containers\AppSection\Authorization\Data\Factories
 */
class PermissionFactory extends Factory
{
    /**
     * Hold model class.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->slug,
        ];
    }
}
