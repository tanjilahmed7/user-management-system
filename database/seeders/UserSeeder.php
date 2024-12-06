<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific users
        $admin = User::factory()->create([
            'id'       => 1, // Force ID 1
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);

        $user = User::factory()->create([
            'id'       => 2, // Force ID 2
            'name'     => 'Regular User',
            'email'    => 'user@example.com',
            'password' => bcrypt('user123'),
        ]);

        // Assign roles
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        $admin->roles()->sync([$adminRole->id]);
        $user->roles()->sync([$userRole->id]);

        // Assign specific permissions to user ID 2
        DB::table('permission_user')->insert([
            ['user_id' => 2, 'permission_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'permission_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'permission_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
