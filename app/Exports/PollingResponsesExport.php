<?php

namespace App\Exports;

use App\Models\Polling;
use App\Models\PollingResponse;
use App\Models\QuestionOption;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PollingResponsesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }
    public function view(): View
    {
        $polling = Polling::where('slug', $this->slug)->with(['questions'])->latest()->first();
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
        return view('super.polling.response', [
            'polling' => $polling,
            'optionNames' => $optionNames,
        ]);
    }
}
