<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
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
        $data_pengaduan = Pengaduan::all();

        return view('super.pengaduan.index', [
            'data_pengaduan' => $data_pengaduan
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
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'respon' => 'required'
        ]);
        Respon::create([
            'pengaduan_id' => $id,
            'respon' => $request->respon,
            'user_id' => Auth::id(),
            'status' => 'menjawab'
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menjawab pengaduan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);


        return view('super.pengaduan.show', [
            'pengaduan' => $pengaduan
        ]);
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
        $this->validate($request,[
            'status' => 'required'
        ]);
        $pengaduan = Pengaduan::where('id',$id)->first();

        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with([
            'success' => 'Berhasil update status pengaduan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (File::exists($pengaduan->lokasi_file . '/' . $pengaduan->nama_file)) {
            File::delete($pengaduan->lokasi_file . '/' . $pengaduan->nama_file);
        }
        $pengaduan->delete($pengaduan);

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus pengaduan!'
        ]);
    }

    public function delete($id)
    {
        $respon = Respon::find($id);
        $respon->delete($respon);

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus respon!'
        ]);
    }


    public function new(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);


        Pengaduan::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'title' => $request->title,
            'body' => $request->body,
            'status' => 'pending'
        ]);

        return redirect()->back();
    }
}
