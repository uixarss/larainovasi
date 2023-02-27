<?php

namespace App\Http\Controllers\Guest;

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
        $user = User::find(Auth::id());
        $guest = User::where('email', $user->email)->first();
        if ($guest != null) {
            $data_penelitian = Penelitian::where('upload_by', $guest->id)->get();
        }else{
            $data_penelitian = [];
        }
        return view('guest.penelitian.index',[
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
        return view('guest.penelitian.create');
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
            'status' => "draft",
            'file_name_full_article' => $filename,
            'loc_file_name_full_article' => 'admin-bsb/uploads/penelitian',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/guest/penelitian')->with(['success' => 'Berhasil menambah penelitian']);
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
        return view('guest.penelitian.edit',[
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
        $this -> validate($request, [
            'title' => 'required',
            'abstract' => 'required',
            'description' => 'required',
            'keyword' => 'required',
            'author' => 'required',
            'institution' => 'required',
            'file_penelitian' => 'required'
        ]);
        $penelitian = Penelitian::find($id);

        if($request->hasFile('file_penelitian')){
            $file = $request->file('file_penelitian');
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            if(File::exists($file)){
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
            'file_name_full_article' => $filename,
            'loc_file_name_full_article' => 'admin-bsb/uploads/penelitian',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/guest/penelitian')->with(['success' => 'Berhasil diubah']);
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
        $penelitian->delete($penelitian);

        return redirect('/guest/penelitian')->with(['success' => 'Berhasil menghapus penelitian']);
    }

    public function download($id)
    {
        $filename = Penelitian::where('id', $id)->first();
        $file = 'admin-bsb/uploads/penelitian/'.$filename->file_name_full_article;

        return response()->download($file);
    }
}
