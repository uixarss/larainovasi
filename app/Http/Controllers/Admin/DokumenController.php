<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DokumenController extends Controller
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
        $data_dokumen = Dokumen::all();

        return view('super.dokumen.index', [
            'data_dokumen' => $data_dokumen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_jenis_dokumen = JenisDokumen::all();
        return view('super.dokumen.create',[
            'data_jenis_dokumen' => $data_jenis_dokumen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'jenisdokumen' => 'required',
            'file_dokumen' => 'required|max:10240|mimes:pdf'
        ]);

        $file = $request->file('file_dokumen');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/uploads/dokumen/', $filename);
        
        Dokumen::create([
            'name' => $request->name,
            'jenis_dokumen_id' => $request->jenisdokumen,
            'nama_file' => $filename,
            'lokasi_file' => 'admin-bsb/uploads/dokumen',
        ]);

        return redirect('/admin/dokumen')->with(['success' => 'Berhasil menambah dokumen baru']);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);
        if (File::exists($dokumen->lokasi_file.'/'. $dokumen->nama_file)) {
            File::delete($dokumen->lokasi_file.'/'. $dokumen->nama_file);
            $dokumen->delete();
            return redirect()->back()->with([
                'success' => 'Berhasil hapus file dokumen!'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Gagal hapus file dokumen!'
            ]);
        }
        
    }
    public function download($id)
    {
        $filename = Dokumen::where('id', $id)->first();
        $file = $filename->lokasi_file . '/' .$filename->nama_file;

        return response()->download($file);
    }
}
