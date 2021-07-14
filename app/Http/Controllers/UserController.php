<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
// use RealRashid\SweetAlert\Facades\Alert;
use Alert;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-show', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-manage||user-show', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function profile()
    {
        $user = Auth::user();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $provinces = Province::pluck('name', 'id');
        $cities = City::where('province_id', $user->province_id)->pluck('name', 'id')->all();
        $districts = District::where('city_id', $user->city_id)->pluck('name', 'id')->all();
        $villages = Village::where('district_id', $user->district_id)->pluck('name', 'id')->all();
        return view('profile', compact('user', 'roles', 'userRole', 'provinces', 'cities', 'districts', 'villages'));
    }

    public function updateprofile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if (!empty($request->foto)) {
            $imageName = $request->name . '-' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/profile-image'), $imageName);
            $input['foto'] = $imageName;
            if (File::exists(public_path('storage/profile-image/' . $user->foto))) {
                File::delete(public_path('storage/profile-image/' . $user->foto));
            }
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User updated successfully');
        return redirect()->route('profile');
    }

    public function index()
    {
        $data = User::latest()->get();
        return view('admin.users.index', compact('data'))->with('i', 0);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'telp' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            // 'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if (!empty($request->foto)) {
        //     $imageName = $request->name. '-' . $request->foto->getClientOriginalName();
        //     $request->foto->move(public_path('storage/profile-image'), $imageName);
        // }
        // $input['foto'] = $imageName;

        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->all());
        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User created successfully');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $provinces = Province::pluck('name', 'id');
        $cities = City::where('province_id', $user->province_id)->pluck('name', 'id')->all();
        $districts = District::where('city_id', $user->city_id)->pluck('name', 'id')->all();
        $villages = Village::where('district_id', $user->district_id)->pluck('name', 'id')->all();
        return view('admin.users.show', compact('user', 'roles', 'userRole', 'provinces', 'cities', 'districts', 'villages'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $user = User::find($id);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if (!empty($request->foto)) {
            $imageName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/profile-image'), $imageName);
            $input['foto'] = $imageName;
            if (File::exists(public_path('storage/profile-image/' . $user->foto))) {
                File::delete(public_path('storage/profile-image/' . $user->foto));
            }
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User updated successfully');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Success Title', 'Success Message');
        return redirect()->route('users.index');
    }
}
