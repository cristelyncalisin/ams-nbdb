<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $first_name = $this->faker->unique()->firstName();
        $last_name = $this->faker->unique()->lastName();
        $username = strtolower($first_name) . '.' . strtolower($last_name);

        return [
            'first_name' => $first_name,
            'middle_name' => $this->faker->unique()->lastName(),
            'last_name' => $last_name,
            'email' =>  $username . '@books.gov.ph',
            'username' => $username,
            'password' => Hash::make('password123**'),
            'role' => 'Admin',
            'is_active' => 1
        ];
    }
}
