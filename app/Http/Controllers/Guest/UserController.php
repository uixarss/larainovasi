<?php

namespace App\Http\Controllers\Guest;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::find(Auth::id());

        return view('super.user.index', [
            'users' => $users
        ]);
    }

    public function profile()
    {
        $users = User::find(Auth::id());

        return view('super.profile.index', [
            'user' => $users
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        //Code to change password    

        return redirect()->back()->with(['success' => 'Berhasil mengubah password']);
    }

    public function listRole()
    {
        $roles = Role::with('permissions')->get();


        $permissions = Permission::all();
        return view('super.role.index', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function editRole(Request $request, $id)
    {
        $role = Role::find($id);
    
        //Default, set dua buah variable dengan nilai null
        $permissions = null;
        $hasPermission = null;
        
        //Mengambil data role
        $roles = Role::all()->pluck('name');
        
        //apabila parameter role terpenuhi
        if (!empty($role)) {
            
            //Query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $id)->get()->pluck('name')->all();

            
            
            // Mengambil data permission
            $permissions = Permission::pluck('name', 'id');

        }

        // dd($hasPermission, $permissions);

        return view('super.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'hasPermission' => $hasPermission
        ]);
    }



    public function createRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:roles'
        ]);
        $role = Role::create(['name' => $request->name]);

        return redirect()->back();
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission_name);

        return redirect()->route('super.list.role');
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete($role);
        return redirect()->route('super.list.role');
    }
    public function listPermission()
    {
        $permissions = Permission::all();

        return view('super.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function createPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('super.list.permission');
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete($permission);
        return redirect()->route('super.list.permission');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'roles' => 'required'
        ]);

        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = bcrypt(Str::random(9));
        $new_user->save();

        $new_user->assignRole($request->roles);

        $new_user->save();

        return redirect()->route('super.users')->with(['success' => 'Sukses Menambahkan Data User Baru']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
        $user = User::find($id);

        $user->syncRoles($request->roles);

        $user->save();

        return redirect()->back()->with(['success' => 'Berhasil Mengubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);

        $user->delete($user);

        return redirect()->route('admin.users');
    }
}
