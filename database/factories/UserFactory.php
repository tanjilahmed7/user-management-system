<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Assign a random role to the user
            $role = Role::inRandomOrder()->first();
            $user->roles()->attach($role);
        });
    }
}
