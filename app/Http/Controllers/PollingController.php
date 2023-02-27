<?php

namespace App\Http\Controllers;

use App\Models\Polling;
use Illuminate\Http\Request;

class PollingController extends Controller
{
    public function index()
    {
        $pollings = Polling::where('status', 'on')->orderBy('expire_date', 'DESC')->simplePaginate(8);
        return view('polling', [
            'pollings' => $pollings,
        ]);
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $pollings = Polling::where('status', 'on')->where('name', 'like', "%" . $cari . "%")->orderBy('expire_date', 'DESC')->simplePaginate(8);
        return view('polling', [
            'pollings' => $pollings,
        ]);
    }
    public function show(Polling $polling)
    {
        return view('detailpolling', [
            'polling' => $polling,
        ]);
    }
}
