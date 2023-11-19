<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Judge;
use Illuminate\Support\Str;

class ContestController extends Controller
{
    public function index($eventId) {
        $contests = Contest::where('event_id', $eventId)->get();

        return view('contests.index',[
            'contests' => $contests,
            'eventId' => $eventId,
        ]);
    }

    public function create($eventId) {
        return view('contests.create', ['eventId' => $eventId]);
    }

    public function store(Request $request, $eventId) {
        $request->validate([
            'title' => 'string|required',
            'schedule' => 'string|required',
            'venue' => 'string|required',
            'computation' => 'string|required',
        ]);

        $contest = Contest::create([
            'title' => $request->title,
            'schedule' => $request->schedule,
            'venue' => $request->venue,
            'computation' => $request->computation,
            'event_id' => $eventId, // Ensure you include this line
        ]);

        return redirect('/contests/' . $contest->id)->with('Info', 'A new contest has been created.');
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
