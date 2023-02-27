<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\PemenangLomba;
use Illuminate\Http\Request;

class PemenangLombaController extends Controller
{
    public function postWinner(Request $request, $id)
    {
        $this->validate($request,[
            'peserta_id' => 'required',
            'urutan' => 'required',
            'title' => 'required'
        ]);
        $lomba = Lomba::find($id);
        $pemenang = PemenangLomba::create([
            'lomba_id' => $id,
            'peserta_id' => $request->peserta_id,
            'urutan' => $request->urutan,
            'title' => $request->title,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with([
            'Yeay! Berhasil input pemenang lomba '.$lomba->title
        ]);
    }

    public function delete($id)
    {
        $pemenang = PemenangLomba::find($id);
        $pemenang->delete();

        return redirect()->back()->with([
            'Berhasil menghapus pemenang lomba '
        ]);
    }
}
