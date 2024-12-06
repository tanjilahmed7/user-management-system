<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Retrieve all permissions from the permissions table
        $permissions = DB::table('permissions')->pluck('id')->toArray();

        // Retrieve all users except Admin
        $adminRole = Role::where('name', 'Admin')->first();
        $users = User::whereDoesntHave('roles', function ($query) use ($adminRole) {
            $query->where('role_id', $adminRole->id);
        })->get();

        // Loop through each user and assign them random permissions
        foreach ($users as $user) {
            // Get a random number of permissions to assign (e.g., between 1 and 3)
            $permissionsToAssign = array_rand(array_flip($permissions), rand(1, 3)); // Assign 1 to 3 permissions

            // If only one permission is selected, make sure it's an array
            if (!is_array($permissionsToAssign)) {
                $permissionsToAssign = [$permissionsToAssign];
            }

            // Insert each permission for the user
            foreach ($permissionsToAssign as $permissionId) {
                DB::table('permission_user')->insert([
                    'user_id'       => $user->id,
                    'permission_id' => $permissionId,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }

}
