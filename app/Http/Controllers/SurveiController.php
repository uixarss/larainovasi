<?php

namespace App\Http\Controllers;

use App\Models\Polling;
use App\Models\PollingResponse;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveiController extends Controller
{
    public function index($slug)
    {
        $ip = request()->ip();
        $polling = Polling::where('status', 'on')->where('slug', $slug)->with('questions')->first();
        $checkIp = PollingResponse::where('ip', $ip)->where('polling_id', $polling->id)->count();
        if ($checkIp > 0) {
            return redirect()->back()->with(['error' => 'Anda sudah mengisi survey']);
        } else {
            if (now() > $polling->expire_date) {
                return redirect()->back()->with(['error' => 'Survey sudah ditutup!']);
            } else {
                return view('survey', [
                    'polling' => $polling,
                ]);
            }
        }
    }
    public function store(Polling $polling, Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $ip = request()->ip();
        $checkIp = PollingResponse::where('ip', $ip)->where('polling_id', $polling->id)->count();
        if ($checkIp > 0) {
            return redirect()->back()->with(['error' => 'Anda sudah mengisi survey']);
        } else {
            if ($request->options !== null) {
                if (now() > $polling->expire_date) {
                    return redirect()->route('polling.show', $polling->slug)->with(['error' => 'Survey sudah ditutup!']);
                } else {
                    $reponses = DB::table('polling_response');
                    foreach ($request->options as $answer) {
                        $question = explode('-', $answer);
                        $reponses->insert([
                            'ip' => request()->getClientIp(),
                            'polling_id' => $polling->id,
                            'question_id' => $question[0],
                            'option_id' => $question[1],
                            'created_at' => now()
                        ]);
                    }
                    return redirect()->route('survei.sukses', $polling->slug);
                }
            } else {
                return redirect()->back()->with(['error' => 'isi survey terlebih dahulu']);
            }
        }
    }
    public function statistic(Polling $polling)
    {
        $polling = $polling->with(['questions'])->latest()->first();
        return view('detailsurvey', [
            'polling' => $polling,
        ]);
    }
    public function success($slug)
    {
        $polling = Polling::where('slug', $slug)->first();
        $polling = $polling->name;

        return view('success', ['polling' => $polling]);
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
}
