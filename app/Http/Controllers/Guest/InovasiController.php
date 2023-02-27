<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\DokumenInovasiIndikator;
use App\Models\InovasiDaerah;
use App\Models\Kebijakan;
use App\Models\OPD;
use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class InovasiController extends Controller
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
        $data_inovasi = InovasiDaerah::select(['id', 'nama_prg', 'nama_keg', 'nama_sub_keg', 'nama_inovasi', 'tahapan_inovasi', 'waktu_uji_coba', 'waktu_implementasi'])
            ->where('created_by', Auth::id())
            ->orderBy('nama_inovasi', 'DESC')->with(['indikator', 'reward'])->get();


        return view('guest.inovasi.index', [
            'data_inovasi' => $data_inovasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_opd = OPD::orderBy('name', 'ASC')->get();
        $response_urusan = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/bid_urusan/litbang/2021');

        $collection_urusan = collect(json_decode($response_urusan, true));
        $data_urusan = [];
        foreach ($collection_urusan['data'] as  $urusan) {
            $urusan_temp = [
                'nama_bid_urusan' => $urusan['nama_bid_urusan']
            ];
            array_push($data_urusan, $urusan_temp);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/subkeg/litbang/2021');


        $collection_sub_keg = collect(json_decode($response, true));

        $data_sub_keg = [];

        foreach ($collection_sub_keg['data'] as  $data_urusan_semua) {
            foreach ($data_urusan_semua["program"] as  $data_program) {
                foreach ($data_program["kegiatan"] as  $data_kegiatan) {
                    foreach ($data_kegiatan["subkegiatan"] as  $data_sub_kegiatan) {
                        $sub_keg_temp = [
                            'kd_prg' => $data_program['kd_prg'],
                            'nama_prg' => $data_program['nama_prg'],
                            'kd_keg' => $data_kegiatan['kd_keg'],
                            'nama_keg' => $data_kegiatan['nama_keg'],
                            'kd_sub_keg' => $data_sub_kegiatan['kd_sub_keg'],
                            'nama_sub_keg' => $data_sub_kegiatan['nama_sub_keg'],
                        ];
                        array_push($data_sub_keg, $sub_keg_temp);
                    }
                }
            }
        }
        return view('guest.inovasi.create', [
            'data_opd' => $data_opd,
            'data_urusan' => $data_urusan,
            'data_sub_keg' => $data_sub_keg
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
        $this->validate($request, [
            'nama_inovasi' => 'required|unique:inovasi_daerahs',
            'tahapan_inovasi' => 'required',
            'inisiator_inovasi' => 'required',
            'jenis_inovasi' => 'required'
        ]);
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/subkeg/litbang/2021');

        $collection_sub_keg = collect(json_decode($response, true));

        $data_sub_keg = [];

        foreach ($collection_sub_keg['data'] as  $data_urusan_semua) {
            foreach ($data_urusan_semua["program"] as  $data_program) {
                foreach ($data_program["kegiatan"] as  $data_kegiatan) {
                    foreach ($data_kegiatan["subkegiatan"] as  $data_sub_kegiatan) {
                        if ($request->nama_sub_keg == $data_sub_kegiatan['kd_sub_keg']) {
                            $sub_keg_temp = [
                                'kd_prg' => $data_program['kd_prg'],
                                'nama_prg' => $data_program['nama_prg'],
                                'kd_keg' => $data_kegiatan['kd_keg'],
                                'nama_keg' => $data_kegiatan['nama_keg'],
                                'kd_sub_keg' => $data_sub_kegiatan['kd_sub_keg'],
                                'nama_sub_keg' => $data_sub_kegiatan['nama_sub_keg'],
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        } elseif ($request->nama_sub_keg == '') {
                            $sub_keg_temp = [
                                'kd_prg' => null,
                                'nama_prg' => null,
                                'kd_keg' => null,
                                'nama_keg' => null,
                                'kd_sub_keg' => null,
                                'nama_sub_keg' => null,
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        }
                    }
                }
            }
        }


        $new_inovasi = new InovasiDaerah();
        $new_inovasi->kd_prg = $data_sub_keg[0]['kd_prg'];
        $new_inovasi->nama_prg = $data_sub_keg[0]['nama_prg'];
        $new_inovasi->kd_keg = $data_sub_keg[0]['kd_keg'];
        $new_inovasi->nama_keg = $data_sub_keg[0]['nama_keg'];
        $new_inovasi->kd_sub_keg = $data_sub_keg[0]['kd_sub_keg'];
        $new_inovasi->nama_sub_keg = $data_sub_keg[0]['nama_sub_keg'];
        $new_inovasi->nama_prg = $request->nama_prg;
        $new_inovasi->nama_keg = $request->nama_keg;
        $new_inovasi->nama_sub_keg = $request->nama_sub_keg;
        $new_inovasi->nama_inovasi = $request->nama_inovasi;
        $new_inovasi->opd_id = $request->opd_id;
        $new_inovasi->tahapan_inovasi = $request->tahapan_inovasi;
        $new_inovasi->inisiator_inovasi = $request->inisiator_inovasi;
        $new_inovasi->jenis_inovasi = $request->jenis_inovasi;
        $new_inovasi->bentuk_inovasi = $request->bentuk_inovasi;
        $new_inovasi->urusan_inovasi = $request->urusan_inovasi;
        $new_inovasi->waktu_uji_coba = $request->waktu_uji_coba;
        $new_inovasi->waktu_implementasi = $request->waktu_implementasi;
        $new_inovasi->rancang_inovasi = $request->rancang_bangun;
        $new_inovasi->tujuan_inovasi = $request->tujuan_inovasi;
        $new_inovasi->manfaat_inovasi = $request->manfaat_inovasi;
        $new_inovasi->hasil_inovasi = $request->hasil_inovasi;
        $new_inovasi->anggaran_inovasi = $request->anggaran_inovasi;
        $new_inovasi->profil_bisnis = $request->profil_bisnis;
        $new_inovasi->created_by = Auth::id();
        $new_inovasi->save();

        return redirect()->route('guest.list.inovasi')->with(['success' => 'Berhasil menambah data inovasi!']);
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
        $inovasi = InovasiDaerah::find($id);
        $data_opd = OPD::orderBy('name', 'ASC')->get();
        $response_urusan = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/bid_urusan/litbang/2021');

        $collection_urusan = collect(json_decode($response_urusan, true));
        $data_urusan = [];
        foreach ($collection_urusan['data'] as  $urusan) {
            $urusan_temp = [
                'nama_bid_urusan' => $urusan['nama_bid_urusan']
            ];
            array_push($data_urusan, $urusan_temp);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/subkeg/litbang/2021');


        $collection_sub_keg = collect(json_decode($response, true));

        $data_sub_keg = [];

        foreach ($collection_sub_keg['data'] as  $data_urusan_semua) {
            foreach ($data_urusan_semua["program"] as  $data_program) {
                foreach ($data_program["kegiatan"] as  $data_kegiatan) {
                    foreach ($data_kegiatan["subkegiatan"] as  $data_sub_kegiatan) {
                        $sub_keg_temp = [
                            'kd_prg' => $data_program['kd_prg'],
                            'nama_prg' => $data_program['nama_prg'],
                            'kd_keg' => $data_kegiatan['kd_keg'],
                            'nama_keg' => $data_kegiatan['nama_keg'],
                            'kd_sub_keg' => $data_sub_kegiatan['kd_sub_keg'],
                            'nama_sub_keg' => $data_sub_kegiatan['nama_sub_keg'],
                        ];
                        array_push($data_sub_keg, $sub_keg_temp);
                    }
                }
            }
        }
        return view('guest.inovasi.edit', [
            'inovasi' => $inovasi,
            'data_urusan' => $data_urusan,
            'data_sub_keg' => $data_sub_keg,
            'data_opd' => $data_opd
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
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1fe2e49a4082f6d1f18b66b9ecea4057'
        ])->get('http://perencanaan.cirebonkab.go.id/api/get_data/ref/subkeg/litbang/2021');

        $collection_sub_keg = collect(json_decode($response, true));

        $data_sub_keg = [];

        foreach ($collection_sub_keg['data'] as  $data_urusan_semua) {
            foreach ($data_urusan_semua["program"] as  $data_program) {
                foreach ($data_program["kegiatan"] as  $data_kegiatan) {
                    foreach ($data_kegiatan["subkegiatan"] as  $data_sub_kegiatan) {
                        if ($request->nama_sub_keg == $data_sub_kegiatan['kd_sub_keg']) {
                            $sub_keg_temp = [
                                'kd_prg' => $data_program['kd_prg'],
                                'nama_prg' => $data_program['nama_prg'],
                                'kd_keg' => $data_kegiatan['kd_keg'],
                                'nama_keg' => $data_kegiatan['nama_keg'],
                                'kd_sub_keg' => $data_sub_kegiatan['kd_sub_keg'],
                                'nama_sub_keg' => $data_sub_kegiatan['nama_sub_keg'],
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        } elseif ($request->nama_sub_keg == '') {
                            $sub_keg_temp = [
                                'kd_prg' => null,
                                'nama_prg' => null,
                                'kd_keg' => null,
                                'nama_keg' => null,
                                'kd_sub_keg' => null,
                                'nama_sub_keg' => null,
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        }
                    }
                }
            }
        }

        $new_inovasi = InovasiDaerah::find($id);
        $new_inovasi->kd_prg = $data_sub_keg[0]['kd_prg'];
        $new_inovasi->nama_prg = $data_sub_keg[0]['nama_prg'];
        $new_inovasi->kd_keg = $data_sub_keg[0]['kd_keg'];
        $new_inovasi->nama_keg = $data_sub_keg[0]['nama_keg'];
        $new_inovasi->kd_sub_keg = $data_sub_keg[0]['kd_sub_keg'];
        $new_inovasi->nama_sub_keg = $data_sub_keg[0]['nama_sub_keg'];
        $new_inovasi->nama_inovasi = $request->nama_inovasi;
        $new_inovasi->opd_id = $request->opd_id;
        $new_inovasi->nama_prg = $request->nama_prg;
        $new_inovasi->nama_keg = $request->nama_keg;
        $new_inovasi->nama_sub_keg = $request->nama_sub_keg;
        $new_inovasi->tahapan_inovasi = $request->tahapan_inovasi;
        $new_inovasi->inisiator_inovasi = $request->inisiator_inovasi;
        $new_inovasi->jenis_inovasi = $request->jenis_inovasi;
        $new_inovasi->bentuk_inovasi = $request->bentuk_inovasi;
        $new_inovasi->urusan_inovasi = $request->urusan_inovasi;
        $new_inovasi->waktu_uji_coba = $request->waktu_uji_coba;
        $new_inovasi->waktu_implementasi = $request->waktu_implementasi;
        $new_inovasi->rancang_inovasi = $request->rancang_bangun;
        $new_inovasi->tujuan_inovasi = $request->tujuan_inovasi;
        $new_inovasi->manfaat_inovasi = $request->manfaat_inovasi;
        $new_inovasi->hasil_inovasi = $request->hasil_inovasi;
        $new_inovasi->anggaran_inovasi = $request->anggaran_inovasi;
        $new_inovasi->profil_bisnis = $request->profil_bisnis;
        $new_inovasi->save();
        return redirect()->back()->with(['success' => 'Berhasil mengubah data inovasi!']);
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
        $inovasi = InovasiDaerah::find($id);
        $inovasi->delete($inovasi);

        return redirect()->back()->with(['success' => 'Inovasi dihapus']);
    }

    public function listIndikator($id)
    {
        $inovasi = InovasiDaerah::find($id);
        $data_indikator = Indikator::orderBy('id', 'ASC')->with('inovasi')->get();

        return view('guest.inovasi.indikator', [
            'inovasi' => $inovasi,
            'data_indikator' => $data_indikator
        ]);
    }

    public function updateIndikator($id_inovasi, $id_indikator, Request $request)
    {
        $nilai = (int) $request->nilai;
        $this->validate($request, [
            'nilai' => 'required'
        ]);
        $inovasi = InovasiDaerah::find($id_inovasi);
        $indikator_inovasi = $inovasi->indikator;
        if ($indikator_inovasi->count() > 0) {
            $inovasi->indikator()->syncWithoutDetaching(
                [$id_indikator => ['bobot' => $nilai]]
            );
        } else {
            $inovasi->indikator()->attach(
                $id_indikator,
                ['bobot' => $nilai]
            );
        }



        return redirect()->back()->with(['success' => 'Berhasil menambah parameter']);
    }

    public function uploadDokumenIndikator($id_inovasi, $id_indikator, Request $request)
    {
        $this->validate($request, [
            'nama_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,mp4,jpg,jpeg,png'
        ]);


        $file = $request->file('nama_file');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/uploads/inovasi/dokumen', $filename);

        $dokumen_inovasi = DokumenInovasiIndikator::where('indikator_id', $id_indikator)
            ->where('inovasi_id', $id_inovasi)->first();
        if ($dokumen_inovasi != null) {
            // update dokumen
            if (File::exists($file)) {
                $file->move('admin-bsb/uploads/inovasi/dokumen', $filename);
                File::delete($file);
            }
            $dokumen_inovasi->indikator_id = $id_indikator;
            $dokumen_inovasi->inovasi_id = $id_inovasi;
            $dokumen_inovasi->nomor_surat = $request->nomor_surat;
            $dokumen_inovasi->tanggal_surat = $request->tanggal_surat;
            $dokumen_inovasi->tentang = $request->tentang;
            $dokumen_inovasi->nama_file = $filename;
            $dokumen_inovasi->lokasi_file = 'admin-bsb/uploads/inovasi/dokumen';
            $dokumen_inovasi->save();
            return redirect()->back()->with(['success' => 'Berhasil update dokumen!']);
        } else {
            // create dokumen
            $new_dokumen = new DokumenInovasiIndikator;
            $new_dokumen->indikator_id = $id_indikator;
            $new_dokumen->inovasi_id = $id_inovasi;
            $new_dokumen->nomor_surat = $request->nomor_surat;
            $new_dokumen->tanggal_surat = $request->tanggal_surat;
            $new_dokumen->tentang = $request->tentang;
            $new_dokumen->nama_file = $filename;
            $new_dokumen->lokasi_file = 'admin-bsb/uploads/inovasi/dokumen';
            $new_dokumen->save();
            return redirect()->back()->with(['success' => 'Berhasil upload dokumen baru!']);
        }
    }
}
