<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PollingResponsesExport;
use App\Http\Controllers\Controller;
use App\Models\Polling;
use App\Models\PollingResponse;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\VarDumper\VarDumper;

class PollingController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->middleware('auth');
    }

    public function index()
    {
        $polling = Polling::latest()->get();
        $expire = Polling::where('expire_date', '<', now())->count();
        return view('super.polling.index', ['polling' => $polling, 'expire' => $expire]);
    }
    public function create()
    {
        return view('super.polling.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'author_id' => 'required',
            'status' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png|max:1024',
        ]);

        try {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = 'polling_' . time() . '.' . $extension;
                $file->move('polling/images/', $filename);
            }

            $polling = Polling::create([
                'author_id' => $request->author_id,
                'slug' => \Str::slug($request->name),
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'expire_date' => $request->expire_date,
                'thumbnail' => $filename,
            ]);
            return redirect()->route('admin.polling.edit', $polling->slug)->with(['success' => "Berhasil tambah polling"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit(Polling $polling)
    {
        $question = Question::where('polling_id', $polling->id)->with(['options'])->get();
        return view('super.polling.edit', [
            'polling' => $polling,
            'question' => $question
        ]);
    }
    public function update(Request $request, Polling $polling)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'author_id' => 'required',
            'status' => 'required',
            'thumbnail' => 'image|mimes:jpg,png|max:1024',
        ]);

        if ($request->expire_date == null) {
            $request->expire_date = $polling->expire_date;
        }

        try {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = 'polling_' . time() . '.' . $extension;
                if (File::exists('polling/images/' . $polling->thumbnail)) {
                    $file->move('polling/images/', $filename);
                    File::delete('polling/images/' . $polling->thumbnail);
                }
                $polling->update([
                    'author_id' => $request->author_id,
                    // 'slug' => \Str::slug($request->name),
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'expire_date' => $request->expire_date,
                    'thumbnail' => $filename,
                ]);
            } else {
                $polling->update([
                    'author_id' => $request->author_id,
                    // 'slug' => \Str::slug($request->name),
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'expire_date' => $request->expire_date,
                ]);
            }
            return redirect()->back()->with(['success' => "Berhasil update polling"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy(Polling $polling)
    {

        if (File::exists('polling/images/' . $polling->thumbnail)) {
            File::delete('polling/images/' . $polling->thumbnail);
        }

        $polling->delete($polling);

        return redirect()->back()->with(['success' => "Berhasil hapus data"]);
    }

    public function statistics($slug)
    {
        $polling = Polling::where('slug', $slug)->with(['questions'])->latest()->first();
        $questionOption = $data = DB::table('polling_response')
            ->select(DB::raw("GROUP_CONCAT(option_id) as `options`"))
            ->groupBy('question_id')
            ->get();
        $optionNames = [];
        foreach ($questionOption as $option) {
            $option_id = explode(',', $option->options);
            foreach ($option_id as $id) {
                $opt = QuestionOption::where('id', $id)->with('question')->first();
                $optionNames[] = $opt;
            }
        }
        return view('super.polling.statistic', [
            'polling' => $polling,
            'optionNames' => $optionNames,
        ]);
    }
    public function getOptions($id)
    {
        if (request()->ajax()) {
            $option = QuestionOption::where('question_id', $id)->get();
            return response()->json($option, 200);
        }
    }
    public function getOptionsAnswers($id)
    {
        if (request()->ajax()) {
            $optionsList = QuestionOption::where('question_id', $id)->get();
            $options = [];
            foreach ($optionsList as $opt) {
                $options[] = PollingResponse::where('option_id', $opt->id)->count();
            }
            return response()->json($options, 200);
        }
    }
    public function export($slug)
    {
        $slug = Polling::where('slug', $slug)->first();
        if ($slug == null) {
            abort(404);
        } else {
            return Excel::download(new PollingResponsesExport($slug->slug), 'pollingresponse--' . date('YmdHis') . '.csv');
        }
    }
}
