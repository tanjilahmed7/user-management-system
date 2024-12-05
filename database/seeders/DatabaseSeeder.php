<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Post Factory
         \App\Models\Article::factory(10)->create();

        // Call the seeders
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            //RolePermissionSeeder::class,
            UserSeeder::class,
            AssignPermissionsSeeder::class,
        ]);
    }
}
