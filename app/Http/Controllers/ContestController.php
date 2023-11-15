<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Judge;
use Illuminate\Support\Str;

class ContestController extends Controller
{
    public function index() {
        $contests = Contest::get();

        return view('contests.index',[
            'contests' => $contests
        ]);
    }

    public function create() {
        return view('contests.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'schedule' => 'string|required',
            'venue' => 'string|required',
        ]);

        $contest = Contest::create([
            'title' => $request->title,
            'schedule' => $request->schedule,
            'venue' => $request->venue,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/contests/' . $contest->id)->with('Info','A new contest has been created.');
    }

    public function show(Contest $contest) {
        $computation = [];


        $allSumOfRanks=[];

        foreach($contest->contestants as $contestant) {
            $row = [];
            $row[] = "#" . $contestant->number . " " . $contestant->name . ($contestant->remarks ? "<br/>" . $contestant->remarks : "");
            $sumOfRanks=0;

            foreach($contest->judges as $judge) {
                $row[] = \App\Models\Score::judgeTotal($judge->id, $contestant->id);
                $row[] = $rank = $judge->rank($contestant);
                $sumOfRanks += $rank;
            }

            $row['sumOfRank'] = $sumOfRanks;

            $allSumOfRanks[] = $sumOfRanks;
            $computation[$contestant->id] = $row;
        }

        foreach($contest->contestants as $contestant) {
            $computation[$contestant->id]['finalRank'] = Judge::computeRank($allSumOfRanks, $computation[$contestant->id]['sumOfRank'],false);
        }

        return view('contests.show', [
            'contest' => $contest,
            'computation' => $computation
        ]);
    }
}
