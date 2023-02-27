<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OpdController extends Controller
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
        $opdes = OPD::orderBy('name', 'ASC')->get();

        return view('super.opd.index', [
            'opdes' => $opdes
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
        $this->validate($request, [
            'name' => 'required|unique:opdes'
        ]);
        $new_opd = OPD::create([
            'name' => $request->name,
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->back()->with(['success' => 'Berhasil menambah OPD baru!']);
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

    public function sync()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/unit/litbang/2021');


        $collection_unit = collect(json_decode($response, true));
        OPD::truncate();
        foreach ($collection_unit['data'] as  $data_unit) {

            OPD::create([
                'kd_unit' => $data_unit['kd_unit'],
                'kd_bid_urusan' => $data_unit['kd_bid_urusan'],
                'urut_bid_urusan' => $data_unit['urut_bid_urusan'],
                'nama_bid_urusan' => $data_unit['nama_bid_urusan'],
                'urut_unit' => $data_unit['urut_unit'],
                'name' => $data_unit['nama_unit'],
                'created_by' => 'System',
                'updated_by' => 'System'
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Berhasil update SKPD'
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
        //
        $this->validate($request, [
            'name' => 'required|unique:opdes'
        ]);
        $opd = OPD::find($id);

        $opd->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with(['success' => 'Berhasil mengubah nama OPD!']);
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
        $opd = OPD::find($id);
        $opd->delete($opd);

        return redirect()->back()->with(['success' => 'Berhasil dihapus!']);
    }
}
