<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return Collection
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);

        return Role::create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return $role;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
}
