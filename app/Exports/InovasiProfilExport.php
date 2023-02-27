<?php

namespace App\Exports;

use App\Models\InovasiDaerah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class InovasiProfilExport implements FromView, WithTitle
{

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
        return view('super.inovasi.profile',[
            'inovasi' => $inovasi
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Profil Inovasi Daerah';
    }
}
