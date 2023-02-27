<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use App\Models\Dokumen;
use App\Models\FAQ;
use App\User;
use App\Models\InovasiDaerah;
use App\Models\JenisDokumen;
use App\Models\Kkn;
use App\Models\Lomba;
use App\Models\Penelitian;
use App\Models\Pengaduan;
use App\Models\Peserta;
use App\Models\PesertaLomba;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postPublished = Post::where('status', 'published')->count();
        $postDraft = Post::where('status', 'draft')->count();
        $data_inovasi = InovasiDaerah::select(['id', 'nama_inovasi', 'tahapan_inovasi', 'waktu_uji_coba', 'waktu_implementasi'])->orderBy('nama_inovasi', 'DESC')->get();
        $data_penelitian = Penelitian::all();
        $data_kkn = Kkn::all();
        $data_dokumen = Dokumen::all();
        $data_pengaduan = Pengaduan::all();
        $data_api = ApiToken::all();
        $users = User::all();
        $data_role = Role::withCount('users')->get();
        $data_jenis_dokumen = JenisDokumen::all();
        $data_faq = FAQ::all();
        return view('home', [
            'data_inovasi' => $data_inovasi,
            'data_user' => $users,
            'data_penelitian' => $data_penelitian,
            'data_kkn' => $data_kkn,
            'data_dokumen' => $data_dokumen,
            'data_api' => $data_api,
            'data_pengaduan' => $data_pengaduan,
            'data_jenis_dokumen' => $data_jenis_dokumen,
            'data_role' => $data_role,
            'data_faq' => $data_faq,
            'data_post_draft' => $postDraft,
            'data_post_published' => $postPublished,
        ]);
    }

    public function profile()
    {
        $users = User::find(Auth::id());

        return view('users.profile', [
            'user' => $users
        ]);
    }

    public function updateProfile(Request $request)
    {
        $users = User::find(Auth::id());
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'nickname' => 'required'
        ]);

        $users->update([
            'name' => $request->name,
            'username' => $request->username,
            'nick_name' => $request->nickname
        ]);

        return redirect()->back()->with(['success' => 'Berhasil mengubah data akun']);
    }

    public function updateOPDProfile(Request $request)
    {
        $users = User::find(Auth::id());
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'nickname' => 'required',
            'opdname' => 'required'
        ]);

        $users->update([
            'name' => $request->name,
            'username' => $request->username,
            'nick_name' => $request->nickname,
            'opd_name' => $request->opdname
        ]);

        return redirect()->back()->with(['success' => 'Berhasil mengubah data akun']);
    }

    public function updateSuperProfile(Request $request)
    {
        $users = User::find(Auth::id());
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'nickname' => 'required',
            'opdname' => 'required'
        ]);

        $users->update([
            'name' => $request->name,
            'username' => $request->username,
            'nick_name' => $request->nickname,
            'opd_name' => $request->opdname
        ]);

        return redirect()->back()->with(['success' => 'Berhasil mengubah data akun']);
    }

    public function settings()
    {
        $users = User::find(Auth::id());

        return view('users.settings', [
            'user' => $users
        ]);
    }

    public function updateSettings(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);

        $users = User::find(Auth::id());
        $users->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with(['success' => 'Berhasil mengubah password']);
    }



    public function getDataKegPrg(Request $request)
    {
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
                        if ($request->kd_sub_keg == $data_sub_kegiatan['kd_sub_keg']) {
                            $sub_keg_temp = [
                                'kd_prg' => $data_program['kd_prg'],
                                'nama_prg' => $data_program['nama_prg'],
                                'kd_keg' => $data_kegiatan['kd_keg'],
                                'nama_keg' => $data_kegiatan['nama_keg'],
                                'kd_sub_keg' => $data_sub_kegiatan['kd_sub_keg'],
                                'nama_sub_keg' => $data_sub_kegiatan['nama_sub_keg'],
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        } elseif ($request->kd_sub_keg == '') {
                            $sub_keg_temp = [
                                'kd_prg' => '',
                                'nama_prg' => '',
                                'kd_keg' => '',
                                'nama_keg' => '',
                                'kd_sub_keg' => '',
                                'nama_sub_keg' => '',
                            ];
                            array_push($data_sub_keg, $sub_keg_temp);
                        }
                    }
                }
            }
        }


        return response()->json($data_sub_keg);
    }


    public function registrasiLomba($id)
    {
        $user = Auth::user();
        $lomba = Lomba::find($id);
        if ($lomba == null) {
            abort(404);
        }
        $peserta = Peserta::where('user_id', Auth::id())->first();
        if ($peserta == null) {
            return view('guest.lomba.registrasi', [
                'user' => $user,
                'lomba' => $lomba
            ]);
        }
        return view('guest.lomba.registrasi', [
            'user' => $user,
            'peserta' => $peserta,
            'lomba' => $lomba
        ]);
    }

    public function registerLomba(Request $request, $id)
    {
        $this->validate($request, [
            'no_hp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nama_institusi' => 'required',
            'alamat_institusi' => 'required',
            'judul_dokumen_lomba' => 'required',
            'file_dokumen_lomba' => 'required|max:3000|file',
        ]);
        $lomba = Lomba::find($id);
        $peserta = Peserta::where('user_id', Auth::id())->first();
        if ($peserta == null) {
            // jika user blm dapat id peserta lomba
            $peserta = Peserta::create([
                'user_id' => Auth::id(),
                'no_hp' => $request->no_hp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nama_institusi' => $request->nama_institusi,
                'alamat_institusi' => $request->alamat_institusi,
            ]);
        }
        $peserta_lomba = PesertaLomba::where('peserta_id', $peserta->id)->where('lomba_id', $lomba->id)->first();
        if ($peserta_lomba == null) {
            // buat peserta lomba baru
            $file_dokumen_lomba = $request->file('file_dokumen_lomba');
            $file_name = $file_dokumen_lomba->getClientOriginalName();
            $thumbnail_extension = $file_dokumen_lomba->getClientOriginalExtension();
            $file_dokumen_lomba->move('admin-bsb/lomba/' . $lomba->id . '/', $file_name);

            PesertaLomba::create([
                'peserta_id' => $peserta->id,
                'lomba_id' => $id,
                'kode_peserta' => Str::random(10),
                'judul_dokumen_lomba' => $request->judul_dokumen_lomba,
                'nama_dokumen_lomba' => $file_name,
                'lokasi_dokumen_lomba' => 'admin-bsb/lomba/' . $lomba->id,
            ]);

            return redirect()->route('thankyou');
        } else {

            return redirect()->back()->with([
                'error' => 'Sudah terdaftar'
            ]);
        }
    }
}
