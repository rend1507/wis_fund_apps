<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserBasic>
 */
class UserBasicFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_user_basic' => fake()->name(),
            'email_user_basic' => fake()->unique()->safeEmail(),
            'email_verified_at_user_basic' => now(),
            'password_user_basic' => static::$password ??= Hash::make('password'),
            'remember_token_user_basic' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at_user_basic' => null,
        ]);
    }
}
