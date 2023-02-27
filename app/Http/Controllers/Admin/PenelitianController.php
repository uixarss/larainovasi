<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PenelitianController extends Controller
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
        $data_penelitian = Penelitian::orderBy('created_at', 'DESC')->get();
        return view('super.penelitian.index', [
            'data_penelitian' => $data_penelitian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_penelitian = Penelitian::all();
        return view('super.penelitian.create', [
            'data_penelitian' => $data_penelitian
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
            'title' => 'required',
            'abstract' => 'required',
            'description' => 'required',
            'keyword' => 'required',
            'author' => 'required',
            'institution' => 'required',
            'status' => 'required',
            'file_penelitian' => 'required|mimes:pdf,doc,docx'
        ]);

        $file = $request->file('file_penelitian');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/uploads/penelitian/', $filename);

        Penelitian::create([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'keyword' => $request->keyword,
            'author' => $request->author,
            'institution' => $request->institution,
            'status' => $request->status,
            'file_name_full_article' => $filename,
            'loc_file_name_full_article' => 'admin-bsb/uploads/penelitian',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/admin/penelitian')->with(['success' => 'Berhasil menambah penelitian']);
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
        $data_penelitian = Penelitian::where('id', $id)->first();
        return view('super.penelitian.edit', [
            'data_penelitian' => $data_penelitian
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
            'abstract' => 'required',
            'description' => 'required',
            'keyword' => 'required',
            'author' => 'required',
            'institution' => 'required',
            'status' => 'required',
            'file_penelitian' => 'required'
        ]);
        $penelitian = Penelitian::find($id);

        if ($request->hasFile('file_penelitian')) {
            $file = $request->file('file_penelitian');
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            if (File::exists($file)) {
                $file->move('admin-bsb/uploads/penelitian', $filename);
                File::delete($file);
            }
        }

        $penelitian->update([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'keyword' => $request->keyword,
            'author' => $request->author,
            'institution' => $request->institution,
            'status' => $request->status,
            'file_name_full_article' => $filename,
            'loc_file_name_full_article' => 'admin-bsb/uploads/penelitian',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/admin/penelitian')->with(['success' => 'Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penelitian = Penelitian::find($id);
        if (File::exists($penelitian->loc_file_name_full_article . '/' . $penelitian->file_name_full_article)) {
            File::delete($penelitian->loc_file_name_full_article . '/' . $penelitian->file_name_full_article);
            $penelitian->delete($penelitian);
            return redirect()->back()->with([
                'success' => 'Berhasil hapus file dokumen penelitian!'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Gagal hapus file dokumen penelitian!'
            ]);
        }
    }

    public function download($id)
    {
        $filename = Penelitian::where('id', $id)->first();
        $file = 'admin-bsb/uploads/penelitian/' . $filename->file_name_full_article;

        return response()->download($file);
    }
}
