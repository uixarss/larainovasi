<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InovasiDaerah;
use Illuminate\Http\Request;
use App\Models\OPD;

class InovasiController extends Controller
{
    public function all()
    {
        try {
            $data_inovasi = InovasiDaerah::with('reward', 'skpd')->get();
            $data_inovasi = json_decode($data_inovasi);

            return response()->json($data_inovasi);
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function filter(Request $request)
    {
        try {
            $data_inovasi = InovasiDaerah::where('nama_inovasi', 'LIKE', '%' . $request->nama_inovasi . "%")
                ->with('reward', 'skpd')
                ->get();
            if (count($data_inovasi) > 0) {
                $data_inovasi = json_decode($data_inovasi);

                return response()->json($data_inovasi);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!'
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function dataOPD()
    {
        try {
            $data_opd = OPD::orderBy('name', 'ASC')
                ->select([
                    'kd_unit', 'name',
                    'urut_unit', 'nama_bid_urusan',
                    'urut_bid_urusan', 'kd_bid_urusan'
                ])
                ->get();
            $data_opd = json_decode($data_opd);

            return response()->json($data_opd);
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function inovasiOPD($kd_unit)
    {
        try {
            $opd = OPD::where('kd_unit', $kd_unit)
                ->select('id')
                ->get();

            $data_inovasi = InovasiDaerah::whereIn('opd_id', $opd)
                ->with('reward', 'skpd')
                ->get();
            $data_inovasi = json_decode($data_inovasi);

            return response()->json($data_inovasi);
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
