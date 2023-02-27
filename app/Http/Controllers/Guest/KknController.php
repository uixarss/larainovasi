<?php

namespace App\Http\Controllers\Guest;

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
        $user = User::find(Auth::id());
        $guest = User::where('email', $user->email)->first();
        if ($guest != null) {
            $data_kkn = KKN::where('upload_by', $guest->id)->get();
        }else{
            $data_kkn = [];
        }
        return view('guest.kkn.index',[
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
        return view('guest.kkn.create');
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
            'file_kkn' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);
        
        $file = $request->file('file_kkn');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file->move('admin-bsb/uploads/kkn/', $filename);
        
        Kkn::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'institution' => $request->institution,
            'status' => "draft",
            'file_name_doc' => $filename,
            'loc_file_name_doc' => 'admin-bsb/uploads/kkn',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/guest/kkn')->with(['success' => 'Berhasil menambah KKN']);
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
        $data_kkn = Kkn::where('id', $id)->first();
        return view('guest.kkn.edit', [
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
            'file_kkn' => 'required'
        ]);
        $kkn = Kkn::find($id);

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
            'file_name_doc' => $filename,
            'loc_file_name_doc' => 'admin-bsb/uploads/kkn',
            'upload_by' => Auth::id(),
            'publish_by' => Auth::id()
        ]);

        return redirect('/guest/kkn')->with(['success' => 'Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_kkn = Kkn::find($id);
        $data_kkn->delete($data_kkn);

        return redirect('/guest/kkn')->with(['success' => 'Berhasil menghapus KKN']);
    }

    public function download($id)
    {
        $filename = KKN::where('id', $id)->first();
        $file = 'admin-bsb/uploads/kkn/'.$filename->file_name_doc;

        return response()->download($file);
    }
}
