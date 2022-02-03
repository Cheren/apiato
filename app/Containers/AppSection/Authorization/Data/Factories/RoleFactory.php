<?php

namespace App\Containers\AppSection\Authorization\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Containers\AppSection\Authorization\Models\Role;

/**
 * Class RoleFactory
 *
 * @package App\Containers\AppSection\Authorization\Data\Factories
 */
class RoleFactory extends Factory
{
    /**
     * Hold model class.
     *
     * @var string
     */
    protected $model = Role::class;

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
