<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        request()->validate([
            'question' => 'required'
        ]);

        $question = Question::create([
            'polling_id' => request()->polling_id,
            'question' => request()->question
        ]);

        $question_id = $question->id;
        foreach (request()->option as $option) {
            QuestionOption::create([
                'question_id' => $question_id,
                'option' => $option
            ]);
        }
        return redirect()->back()->with(['success' => 'Sukses menambahkan pertanyaan']);
    }
    public function edit($id)
    {
        $question = Question::where('id', $id)->with('options')->first();
        if (request()->addOption) {
            request()->validate([
                'addOption.*' => 'required'
            ]);
            foreach (request()->addOption as $option) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option' => $option
                ]);
            }
        }
        request()->validate([
            'question' => 'required',
        ]);

        $question->update([
            'question' => request()->question
        ]);
        return redirect()->back()->with(['success' => 'berhasil mengubah pertanyaan']);
        // foreach (request()->option as $option) {
        //     foreach($question->options as $opt) {
        //         if ($opt->name == $option) {
        //             DB::table('question_options')
        //                 ->where('option', $option)
        //                 ->update(['option' => optiona]);
        //         }
        //     }
        // }
    }
    public function updateOption($id)
    {
        $option = QuestionOption::where('id', $id)->first();
        $option->update([
            'option' => request()->option
        ]);
    }
    public function destroy($id)
    {
        $question = Question::where('id', $id)->first();
        $question->delete($question);

        return redirect()->back()->with(['success' => "Berhasil hapus data"]);
    }
    public function destroyOption($id)
    {
        $option = QuestionOption::where('id', $id)->first();
        $option->delete($option);

        return redirect()->back()->with(['success' => "Berhasil hapus data"]);
    }
}
