<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Score;

class ContestantController extends Controller
{
    public function store(Request $request, Contest $contest) {
        $request->validate([
            'name' => 'string|required',
            'number' => 'required|numeric',
            'remarks' => 'string',
        ]);

        $contestant=Contestant::create([
            'name' => $request->name,
            'number' => $request->number,
            'remarks' => $request->remarks,
            'contest_id' => $contest->id,

        ]);

        foreach($contest->judges as $judge) {
            foreach($contest->criterias as $criteria) {
                foreach($contest->rounds as $round) {
                    Score::create([
                        'contestant_id' => $contestant->id,
                        'criteria_id' => $criteria->id,
                        'judge_id' => $judge->id,
                        'round_id' => $round->id
                    ]);
                }
            }
        }

        return redirect("/contests/$contest->id")->with('Info','A new contestant has been added.');
    }

    public function show(Contestant $contestant) {
        return view('contestants.show', [
            'contestant' => $contestant
        ]);
    }

    public function update(Contestant $contestant, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'remarks' => 'string|required',
            'number' => 'numeric|required'
        ]);

        $contestant->update($request->only('name','number','remarks'));

        return redirect('/contests/' . $contestant->contest_id)->with('Info','The contestant ' . $contestant->name . ' has been updated.');
    }
}
