<?php

namespace App\Http\Controllers\Opd;

use App\Http\Controllers\Controller;
use App\Models\OPD;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use App\Imports\ImportUser;

class AccountController extends Controller
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
        //
        $users = User::withCount('roles')->get();
        $opdes = OPD::all();
        $roles = Role::withCount('users')->get();

        return view('super.account.index', [
            'users' => $users,
            'opdes' => $opdes,
            'roles' => $roles
        ]);
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
            'name' => 'required',
            'nick_name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->nick_name = $request->nick_name;
        $new_user->username = $request->username;
        $new_user->opd_name = $request->opd_name;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);

        $new_user->save();

        $new_user->assignRole($request->roles);

        return redirect()->back()->with(['success' => 'Berhasil menambah user ' . $request->name]);
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

        $user = User::find($id);
        $user->name = $request->name;
        $user->nick_name = $request->nick_name;
        $user->username = $request->username;
        $user->opd_name = $request->update_opd_name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $user->assignRole($request->update_role);
        $user->save();
        return redirect()->back()->with(['success' => 'Berhasil mengubah data ' . $request->name]);
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

        return redirect()->route('admin.list.account')->with(['success' => 'Berhasil menghapus data']);
    }

    public function import(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|file'
        ]);
        Excel::import(new ImportUser, $request->file);

        return redirect()->back()->with([
            'success' => 'Berhasil import user'
        ]);
    }
}
