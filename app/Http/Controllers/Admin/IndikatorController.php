<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Indikator;
use App\Models\NilaiIndikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
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
        $indikators = Indikator::orderBy('id', 'ASC')->get();
        return view('super.indikator.index',[
            'indikators' => $indikators
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
        //
        $this->validate($request,[
            'nama' => 'required|unique:indikators',
            'keterangan' => 'required',
            'jenis_file' => 'required',
            'data_pendukung' => 'required'
        ]);

        Indikator::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'jenis_file' => $request->jenis_file,
            'data_pendukung' => $request->data_pendukung
        ]);

        return redirect()->back()->with(['success' => 'Berhasil menambah indikator baru!']);
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
        $indikator = Indikator::where('id', $id)->with('nilai')->first();

        return view('super.indikator.edit',[
            'indikator' => $indikator
        ]);
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
        $indikator = Indikator::find($id);

        $indikator->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'jenis_file' => $request->jenis_file,
            'data_pendukung' => $request->data_pendukung
        ]);
        return redirect()->back()->with(['success' => 'Berhasil mengubah info indikator!']);
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
        $indikator = Indikator::find($id);
        $indikator->delete($indikator);

        return redirect()->back()->with(['success' => 'Berhasil menghapus indikator!']);
    }


    public function storeNilai(Request $request, $id)
    {
        $this->validate($request,[
            'uraian' => 'required',
            'nilai' => 'required'
        ]);

        NilaiIndikator::create([
            'indikator_id' => $id,
            'uraian' => $request->uraian,
            'nilai' => $request->nilai
        ]);

        return redirect()->back()->with(['success' => 'Berhasil menambah nilai indikator']);
    }

    public function updateNilai(Request $request, $id)
    {
        $this->validate($request,[
            'uraian' => 'required',
            'nilai' => 'required'
        ]);

        $nilai = NilaiIndikator::find($id);

        $nilai->update([
            'uraian' => $request->uraian,
            'nilai' => $request->nilai
        ]);
        return redirect()->back()->with(['success' => 'Berhasil mengubah nilai indikator']);
    }

    public function deleteNilai($id)
    {
        

        $nilai = NilaiIndikator::find($id);
        
        $nilai->delete();
        return redirect()->back()->with(['success' => 'Berhasil menghapus nilai indikator']);
    }
}
