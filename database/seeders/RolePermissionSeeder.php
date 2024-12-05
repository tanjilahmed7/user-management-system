<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        // Get permissions
        $permissions = Permission::all();

        // Assign all permissions to the Admin role
        $adminRole->permissions()->sync($permissions);

        // Assign only 'view-post' permission to the User role
        $viewPostPermission = Permission::where('name', 'view-post')->first();
        $userRole->permissions()->sync([$viewPostPermission->id]);
    }
}
