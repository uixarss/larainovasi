<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SumberDanaController extends Controller
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
        $data_sumberdana = SumberDana::all();

        return view('super.sumberdana.index', [
            'data_sumberdana' => $data_sumberdana
        ]);
    }

    public function sync()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/dana/litbang/2021');


        $collection_unit = collect(json_decode($response, true));
        SumberDana::truncate();
        foreach ($collection_unit['data'] as  $data_dana) {

            SumberDana::create([
                'kd_dana' => $data_dana['kd_dana'],
                'nama_dana' => $data_dana['nama_dana'],
                'urut_dana' => $data_dana['urut_dana'],
                'tipe' => $data_dana['tipe'],
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Berhasil sync data'
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
        $sumberdana = SumberDana::find($id);

        $sumberdana->update([
            'kd_dana' => $request->kd_dana,
            'urut_dana' => $request->urut_dana,
            'nama_dana' => $request->nama_dana,
            'tipe' => $request->tipe
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil update daftar sumber dana!'
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
        $sumberdana = SumberDana::find($id);
        $sumberdana->delete($sumberdana);

        return redirect()->back()->with([
            'success' => 'Berhasil hapus data!'
        ]);
    }
}
