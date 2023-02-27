<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersyaratanLomba;
use Illuminate\Http\Request;

class PersyaratanLombaController extends Controller
{
    public function add(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'urutan' => 'required'
        ]);

        PersyaratanLomba::create([
            'lomba_id' => $id,
            'name' => $request->title,
            'urutan' => $request->urutan,
            'keterangan' => $request->keterangan,
            'status' => $request->status
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menambah persyaratan'
        ]);
    }

    public function delete($id)
    {
        $syarat = PersyaratanLomba::find($id);
        $syarat->delete($syarat);

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus syarat lomba'
        ]);
    }
}
