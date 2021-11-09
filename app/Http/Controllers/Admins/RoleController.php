<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(5);

        return view('admins.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get()->pluck('name');

        return view('admins.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:roles','max:20'],
            'permission' => ['required'],
        ]);

        $role = Role::create($request->except('permission'));
        // dd($request->permission);
        $permissions = $request->permission ? $request->permission : [];
        $role->givePermissionTo($permissions);

        // return redirect()->route('roles.index')->with('success', "The $role->name was saved successfully");
        return response()->json([
            'status' => 'success',
            'message' => "Create role $request->name berhasil"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = Permission::get()->pluck('name');
        $role = Role::findOrFail($id);
        $data = $role->permissions()->pluck('name');
        $selectedPermissions = $data;
        return view('admins.roles.edit', ['role' => $role, 'permission' => $permissions,'selectedPermissions' => $selectedPermissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','max:20'],
            // 'permission' => ['required'],
        ]);

        $role = Role::findOrFail($id);

        $role->update($request->except('permission'));

        if ($request->input('permission')) {
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            $role->syncPermissions($permissions);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Update role permission berhasil"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $name_role = $role->name;
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Delete Role $name_role berhasil"
        ], 200);
    }
}
