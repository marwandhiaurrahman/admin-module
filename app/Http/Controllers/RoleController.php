<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-show|role-manage', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-manage', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $roles = Role::latest()->get();
        return view('admin.roles.index', compact('roles'))->with('i', 0);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        Alert::success('Success Information', 'Role created successfully');
        return redirect()->route('roles.index');
    }


    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            // 'name' => 'required|unique:roles,name',
            // 'permission' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->update();
        $role->syncPermissions($request->input('permission'));

        Alert::success('Success Information', 'Role updated successfully');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {

        $users = User::role($role->name)->count();
        if ($users > 0) {
            Alert::error('Error Information', 'Role ' . $role->name . ' have ' . $users . ' users');
        } else {
            $role->delete();
            Alert::success('Success Information', 'Role deleted successfully');
        }
        return redirect()->route('roles.index');
    }
}
