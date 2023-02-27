<?php

namespace App\Exports;

use App\Models\DokumenInovasiIndikator;
use App\Models\Indikator;
use App\Models\InovasiDaerah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;

class InovasiIndikatorPerSheet implements FromView, WithTitle
{
    use Exportable;

    protected $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return Builder
     */
    public function view(): View
    {
        $inovasi = InovasiDaerah::find($this->id);
        $data_indikator = Indikator::all();
        $data_dokumen = DokumenInovasiIndikator::where('inovasi_id', $this->id)->get();
        return view('super.inovasi.detail-indikator', [
            'inovasi' => $inovasi,
            'data_indikator' => $data_indikator,
            'data_dokumen' => $data_dokumen

        ]);
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Indikator Inovasi Daerah';
    }
}
