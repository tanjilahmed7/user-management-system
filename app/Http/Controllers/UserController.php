<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function welcome()
    {
        $user = auth()->user();


        return response()->json('Welcome ' . $user->name . '!' . ' You are logged in as ' . $user->role());
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return User::with('roles', 'permissions')->get();
    }


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function assignRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->attach($request->role_id);
        return response()->json(['message' => 'Role assigned successfully']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function removeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach($request->role_id);
        return response()->json(['message' => 'Role removed successfully']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function assignPermission(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the incoming request for permission_id
        $request->validate([
            'permission_id' => 'required|exists:permissions,id', // Validate that the permission exists
        ]);

        // Check if the user already has the permission
        if ($user->permissions->contains('id', $request->permission_id)) {
            return response()->json(['message' => 'Permission already assigned to this user'], 400);
        }

        // Attach the permission to the user
        $user->permissions()->attach($request->permission_id);

        // Return a success message
        return response()->json(['message' => 'Permission assigned successfully']);
    }

}
