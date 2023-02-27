<?php

namespace App\Exports;

use App\Models\Indikator;
use App\Models\InovasiDaerah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InovasiExport implements FromView
{
    
    public function view(): View
    {
        $data_inovasi = InovasiDaerah::select(['id', 'nama_prg', 'nama_keg', 'nama_sub_keg', 'nama_inovasi','opd_id', 'tahapan_inovasi', 'waktu_uji_coba', 'waktu_implementasi'])->orderBy('nama_inovasi', 'DESC')->with(['indikator','skpd'])->get();
        $data_indikator = Indikator::orderBy('id', 'ASC')->with('inovasi')->get();
        return view('exports.inovasi', [
            'data_inovasi' => $data_inovasi,
            'data_indikator' => $data_indikator
        ]);
    }


}
