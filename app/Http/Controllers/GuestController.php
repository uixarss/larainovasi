<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\FAQ;
use App\Models\InovasiDaerah;
use App\Models\Penelitian;
use App\Models\Pengaduan;
use App\Models\Lomba;
use App\Models\PersyaratanLomba;
use App\Models\Polling;
use App\Models\Post;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $data_penelitian = Penelitian::where('status', 'publish')->take(5)->get();
        $data_dokumen = Dokumen::take(5)->get();
        $data_inovasi = InovasiDaerah::take(5)->get();
        $data_lomba = Lomba::all();
        $posts = Post::where('status', 'published')->latest()->take(6)->get();
        $last_update = Post::where('status', 'published')->orderBy('publish_date', 'desc')->first();
        $polling = Polling::where('status', 'on')->latest()->first();

        return view('welcome', [
            'data_penelitian' => $data_penelitian,
            'data_dokumen' => $data_dokumen,
            'data_inovasi' => $data_inovasi,
            'posts' => $posts,
            'last_update' => $last_update,
            'polling' => $polling,
            'data_lomba' => $data_lomba
        ]);
    }

    public function listFaq()
    {
        $data_faq = FAQ::all();

        return view('faq', [
            'data_faq' => $data_faq
        ]);
    }

    public function listPengaduan()
    {
        $data_pengaduan = Pengaduan::orderBy('created_at', 'DESC')->get();

        return view('pengaduan', [
            'data_pengaduan' => $data_pengaduan
        ]);
    }

    public function listDokumen()
    {
        $data_dokumen = Dokumen::all();

        return view('dokumen', [
            'data_dokumen' => $data_dokumen,

        ]);
    }

    public function listPenelitian()
    {
        $data_penelitian = Penelitian::where('status', 'publish')->get();

        return view('penelitian', [
            'data_penelitian' => $data_penelitian
        ]);
    }

    public function listInovasi()
    {
        $data_inovasi = InovasiDaerah::select('id', 'nama_inovasi', 'opd_id', 'nama_prg', 'nama_keg', 'nama_sub_keg')
            ->with(['indikator', 'skpd'])
            ->orderBy('nama_inovasi', 'ASC')
            ->get();

        return view('inovasi', [
            'data_inovasi' => $data_inovasi
        ]);
    }

    public function listLomba()
    {
        $data_lomba = Lomba::all();
        $lomba = Lomba::orderBy('created_at', 'DESC')->first();


        return view('lomba', [
            'data_lomba' => $data_lomba,
            'lomba' => $lomba
        ]);
    }


    public function detailLomba($id)
    {
        $lomba = Lomba::where('id', $id)->first();
        if ($lomba == null) {
            abort(404);
        }

        return view('lombadetail', [
            'lomba' => $lomba,
        ]);
    }

    public function downloadDokumen($id)
    {
        try {
            $dokumen = Dokumen::find($id);
            $filename = $dokumen->lokasi_file . '/' . $dokumen->nama_file;

            return response()->download($filename);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => 'Tidak ada file!'
            ]);
        }
    }
    public function downloadPenelitian($id)
    {
        try {
            $penelitian = Penelitian::find($id);
            $filename = $penelitian->loc_file_name_full_article . '/' . $penelitian->file_name_full_article;

            return response()->download($filename);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => 'Tidak ada file!'
            ]);
        }
    }

    public function thankyou()
    {
        return view('notifikasi');
    }
    public function downloadMekanisme($id)
    {
        try {
            $lomba = Lomba::find($id);
            $filename = $lomba->lokasi_file_mekanisme . '/' . $lomba->file_mekanisme;

            return response()->download($filename);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => 'Tidak ada file!'
            ]);
        }
    }

    public function postPengaduan(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'title' => 'required',
            'body' => 'required',
            'file' => 'required|file|max:1000|mimes:jpeg,png'
        ]);
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/pengaduan/', $file_name);

        Pengaduan::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'title' => $request->title,
            'body' => $request->body,
            'nama_file' => $file_name,
            'lokasi_file' => 'admin-bsb/pengaduan',
            'status' => 'pending'
        ]);

        return redirect()->back()->with([
            'success' => 'Pengaduan sudah dikirim'
        ]);
    }
}
