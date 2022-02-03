<?php

namespace App\Containers\AppSection\User\Data\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Ship\Parents\Factories\Factory;
use App\Containers\AppSection\User\Models\User;

/**
 * Class UserFactory
 *
 * @package App\Containers\AppSection\User\Data\Factories
 */
class UserFactory extends Factory
{
    /**
     * Hold model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        static $password;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password ?: $password = Hash::make('testing-password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_admin' => false,
        ];
    }

    /**
     * State admin.
     *
     * @return UserFactory
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_admin' => true,
            ];
        });
    }

    /**
     * State unverified.
     *
     * @return UserFactory
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function unverified(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
