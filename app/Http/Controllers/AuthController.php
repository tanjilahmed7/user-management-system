<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * AuthController
 * This controller handles user registration, login, and logout.
 * @extends Controller
 * @package App\Http\Controllers
 * @version 1.0
 */

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);


        // Assign the 'User' role to the user
        $userRole = Role::where('name', 'User')->first();
        $user->roles()->sync([$userRole->id]);

        // Assign the 'User' permissions to the user
        $user->permissions()->sync([1, 2, 4]);


        $token = $user->createToken('API Token')->accessToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = Auth::user()->createToken('API Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
