<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLomba;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\Peserta;
use App\Models\PesertaLomba;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_lomba = Lomba::all();


        return view('super.lomba.index', [
            'data_lomba' => $data_lomba
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_jenis_lomba = JenisLomba::all();

        return view(
            'super.lomba.create',
            [
                'data_jenis_lomba' => $data_jenis_lomba
            ]
        );
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
            'title' => 'required',
            'jenis_lomba_id' => 'required',
            'mulai_acara' => 'required',
            'selesai_acara' => 'required',
            'target_peserta' => 'required',
            'penyelenggara' => 'required',
            'lokasi_acara' => 'required',
            'deskripsi_acara' => 'required',
            'status' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'file_mekanisme' => 'required|mimes:pdf,doc,docx'
        ]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = $thumbnail->getClientOriginalName();
        $thumbnail_extension = $thumbnail->getClientOriginalExtension();
        $thumbnail->move('admin-bsb/thumbnail/', $thumbnail_name);

        $mekanisme = $request->file('file_mekanisme');
        $mekanisme_name = $mekanisme->getClientOriginalName();
        $mekanisme_extension = $mekanisme->getClientOriginalExtension();
        $mekanisme->move('admin-bsb/mekanisme', $mekanisme_name);

        Lomba::create([
            'title' => $request->title,
            'jenis_lomba_id' => $request->jenis_lomba_id,
            'mulai_acara' => $request->mulai_acara,
            'selesai_acara' => $request->selesai_acara,
            'target_peserta' => $request->target_peserta,
            'penyelenggara' => $request->penyelenggara,
            'lokasi_acara' => $request->lokasi_acara,
            'deskripsi_acara' => $request->deskripsi_acara,
            'status' => $request->status,
            'nama_thumbnail' => $thumbnail_name,
            'lokasi_thumbnail' => 'admin-bsb/thumbnail',
            'file_mekanisme' => $mekanisme_name,
            'lokasi_file_mekanisme' => 'admin-bsb/mekanisme'
        ]);

        return redirect()->route('admin.list.lomba')->with([
            'success' => 'Berhasil membuat lomba baru'
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
        $lomba = Lomba::where('id', $id)->with('peserta.user')->first();
        $peserta_lomba = PesertaLomba::where('lomba_id', $id)->get();
        if ($lomba == null) {
            abort(404);
        }

        return view('super.lomba.show', [
            'lomba' => $lomba,
            'peserta_lomba' => $peserta_lomba
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
        $data_jenis_lomba = JenisLomba::all();
        $lomba = Lomba::find($id);

        if ($lomba == null) {
            abort(404);
        }


        return view('super.lomba.edit', [
            'lomba' => $lomba,
            'data_jenis_lomba' => $data_jenis_lomba
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
        $this->validate($request, [
            'title' => 'required',
            'jenis_lomba_id' => 'required',
            'mulai_acara' => 'required',
            'selesai_acara' => 'required',
            'target_peserta' => 'required',
            'penyelenggara' => 'required',
            'lokasi_acara' => 'required',
            'deskripsi_acara' => 'required',
            'status' => 'required'
        ]);
        $lomba = Lomba::find($id);
        if ($lomba == null) {
            abort(404);
        }
        $lomba->update([
            'title' => $request->title,
            'jenis_lomba_id' => $request->jenis_lomba_id,
            'mulai_acara' => $request->mulai_acara,
            'selesai_acara' => $request->selesai_acara,
            'target_peserta' => $request->target_peserta,
            'penyelenggara' => $request->penyelenggara,
            'lokasi_acara' => $request->lokasi_acara,
            'deskripsi_acara' => $request->deskripsi_acara,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.list.lomba')->with([
            'success' => 'Berhasil update lomba ' . $lomba->title
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
        $lomba = Lomba::find($id);
        if ($lomba == null) {
            abort(404);
        }
        if (File::exists($lomba->lokasi_thumbnail . '/' . $lomba->nama_thumbnail) || File::exists($lomba->lokasi_file_mekanisme . '/' . $lomba->file_mekanisme)) {
            File::delete($lomba->lokasi_thumbnail . '/' . $lomba->nama_thumbnail);
            File::delete($lomba->lokasi_file_mekanisme . '/' . $lomba->file_mekanisme);
            $lomba->delete();
            return redirect()->back()->with([
                'success' => 'Berhasil hapus file dokumen!'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Gagal hapus file dokumen!'
            ]);
        }
    }

    public function deletePeserta($id)
    {
        $peserta_lomba = PesertaLomba::find($id);
        if ($peserta_lomba == null) {
            abort(404);
        }
        if (File::exists($peserta_lomba->lokasi_dokumen_lomba.'/'.$peserta_lomba->nama_dokumen_lomba)) {
            File::delete($peserta_lomba->lokasi_dokumen_lomba.'/'.$peserta_lomba->nama_dokumen_lomba);
            $peserta_lomba->delete();
            return redirect()->back()->with([
                'success' => 'Berhasil hapus file dokumen lomba!'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Gagal hapus file dokumen!'
            ]);
        }
    }

    public function downloadDokumenPeserta($id)
    {
        $filename = PesertaLomba::where('id', $id)->first();
        $file = $filename->lokasi_dokumen_lomba.'/'.$filename->nama_dokumen_lomba;

        return response()->download($file);
    }

    public function detailPeserta($id, $peserta_id)
    {
        $lomba = Lomba::find($id);
        $peserta_lomba = PesertaLomba::find($peserta_id);
        $peserta = Peserta::find($peserta_lomba->peserta_id);
        return view('super.lomba.detail',[
            'lomba' => $lomba,
            'peserta' => $peserta,
            'peserta_lomba' => $peserta_lomba
        ]);
    }
}
