<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
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
        $data_faq = FAQ::orderBy('created_at', 'ASC')->get();

        return view('super.faq.index', [
            'data_faq' => $data_faq
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'created_by' => Auth::user()->name,
        ]);

        return redirect()->route('admin.list.faq')->with([
            'success' => 'Berhasil menambah FAQ!'
        ]);
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
        $faq = FAQ::find($id);

        return view('super.faq.edit', [
            'faq' => $faq
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
        $faq = FAQ::find($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('admin.list.faq')->with([
            'success' => 'Berhasil update FAQ!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQ::find($id);

        $faq->delete($faq);

        return redirect()->route('admin.list.faq')->with([
            'success' => 'Berhasil hapus FAQ!'
        ]);
    }
}
