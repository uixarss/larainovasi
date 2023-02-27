<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\Peserta;
use App\Models\PesertaLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class LombaController extends Controller
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
    public function index()
    {
        $data_lomba = Lomba::orderBy('created_at', 'DESC')->get();
        $peserta = Peserta::where('user_id', Auth::id())->first();
        if ($peserta == null) {
            $peserta_lomba = [];
            $peserta = [];
        } else {
            $peserta_lomba = PesertaLomba::where('peserta_id', $peserta->id)->get();
        }
        return view('guest.lomba.dashboard', [
            'data_lomba' => $data_lomba,
            'peserta_lomba' => $peserta_lomba,
            'peserta' => $peserta
        ]);
    }

    public function riwayat()
    {
        $peserta = Auth::user()->peserta;

        if (!isset($peserta)) {
            $peserta = '';
        }

        return view('guest.lomba.riwayat', [
            'peserta' => $peserta
        ]);
    }

    public function detail($id)
    {
        $pesertalomba = PesertaLomba::find($id);

        $peserta = Peserta::find($pesertalomba->peserta_id);

        return view('guest.lomba.detail', [
            'peserta' => $peserta,
            'pesertalomba' => $pesertalomba
        ]);
    }

    public function downloadDokumenPeserta($id)
    {
        $filename = PesertaLomba::where('id', $id)->first();
        $file = $filename->lokasi_dokumen_lomba . '/' . $filename->nama_dokumen_lomba;

        return response()->download($file);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nama_institusi' => 'required',
            'alamat_institusi' => 'required',
            'judul_dokumen_lomba' => 'required',
            // 'file' => 'required|file'
        ]);

        $peserta_lomba = PesertaLomba::find($id);

        $peserta = Peserta::find($peserta_lomba->peserta_id);
        $peserta->update([
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_institusi' => $request->nama_institusi,
            'alamat_institusi' => $request->alamat_institusi,
        ]);

        $peserta_lomba->update([
            'judul_dokumen_lomba' => $request->judul_dokumen_lomba,
        ]);
        if ($request->hasFile('file_dokumen_lomba')) {
            $this->validate($request,[
                'dokumen_lomba' => 'mimes:pdf,doc,docx'
            ]);
            File::delete($peserta_lomba->lokasi_dokumen_lomba . '/' . $peserta_lomba->nama_dokumen_lomba);

            $file_dokumen_lomba = $request->file('file_dokumen_lomba');
            $filename = $file_dokumen_lomba->getClientOriginalName();
            $fileextension = $file_dokumen_lomba->getClientOriginalExtension();
            $file_dokumen_lomba->move('admin-bsb/lomba/'. $peserta_lomba->lomba_id, $filename);

            $peserta_lomba->update([
                'lokasi_dokumen_lomba' => 'admin-bsb/lomba/'.$peserta_lomba->lomba_id,
                'nama_dokumen_lomba' => $filename,
            ]);
        }
        return redirect()->back()->with([
            'success' => 'Berhasil update data peserta lomba'
        ]);
    }
}
