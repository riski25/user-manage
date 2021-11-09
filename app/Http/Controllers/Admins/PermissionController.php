<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('admins.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:permissions','max:128'],
        ]);

        // $permission = Permission::create([
        //     $request->all()
        // ]);

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Create permission $request->name berhasil"
        ], 200);

        // return redirect()->route('permissions.index')->with('success', "The $permission->name was saved successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        // var_dump($permission);die;

        return view('admins.permissions.edit', ['permission' => $permission]);
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
            'name' => ['required','unique:permissions','max:128'],
        ]);

        $name = $request->name;

        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Update permission $name berhasil"
        ], 200);
        // return redirect()->route('permissions.index')->with('warning', "The $permission->name was updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $name_permission = $permission->name;
        $permission->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Delete permission $name_permission berhasil"
        ], 200);
    }
}
