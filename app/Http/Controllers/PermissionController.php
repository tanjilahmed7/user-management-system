<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
 * PermissionController class
 * Define the methods for handling permission resources
 * @extends Controller
 * @package App\Http\Controllers
 * @version 1.0
 */

class PermissionController extends Controller
{
    /**
     * @return Collection
     */
    public function index()
    {
        return Permission::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions']);
        return Permission::create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Permission::findOrFail($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return $permission;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
