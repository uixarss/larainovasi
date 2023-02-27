<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InovasiDetailExport implements WithMultipleSheets
{
    use Exportable;

    protected $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function sheets(): array
    {
        $sheets = [];


        $sheets[0] = new InovasiProfilExport($this->id);
        $sheets[1] = new InovasiIndikatorPerSheet($this->id);


        return $sheets;
    }
}
