<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(20)->create(); // Create 20 users

    }
}
