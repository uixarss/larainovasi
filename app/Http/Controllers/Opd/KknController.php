<?php

namespace App\Http\Controllers\Opd;

use App\Http\Controllers\Controller;
use App\Models\Kkn;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class KknController extends Controller
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
        $data_kkn = KKN::orderBy('created_at', 'DESC')->get();
        return view('opd.kkn.index', [
            'data_kkn' => $data_kkn
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opd.kkn.create');
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
            'description' => 'required',
            'author' => 'required',
            'institution' => 'required',
            'status' => 'required',
            'file_kkn' => 'required|mimes:pdf,doc,docx'
        ]);
        
        $file = $request->file('file_kkn');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/uploads/kkn/', $filename);
        
        KKN::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'institution' => $request->institution,
            'status' => $request->status,
            'file_name_doc' => $filename,
            'loc_file_name_doc' => 'admin-bsb/uploads/kkn',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/opd/kkn')->with(['success' => 'Berhasil menambah KKN']);
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
        $data_kkn = KKN::where('id', $id)->first();
        return view('opd.kkn.edit', [
            'data_kkn' => $data_kkn
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
            'description' => 'required',
            'author' => 'required',
            'institution' => 'required',
            'status' => 'required',
            'file_kkn' => 'required'
        ]);
        $kkn = KKN::find($id);

        if($request->hasFile('file_kkn')){
            $file = $request->file('file_kkn');
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            if(File::exists($file)){
                $file->move('admin-bsb/uploads/kkn', $filename);
                File::delete($file);
            }
        }

        $kkn->update([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'institution' => $request->institution,
            'status' => $request->status,
            'file_name_doc' => $filename,
            'loc_file_name_doc' => 'admin-bsb/uploads/kkn',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/opd/kkn')->with(['success' => 'Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_kkn = KKN::find($id);
        $data_kkn->delete($data_kkn);

        return redirect('/opd/kkn')->with(['success' => 'Berhasil menghapus KKN']);
    }

    public function download($id)
    {
        $filename = KKN::where('id', $id)->first();
        $file = 'admin-bsb/uploads/kkn/'.$filename->file_name_doc;

        return response()->download($file);
    }
}
