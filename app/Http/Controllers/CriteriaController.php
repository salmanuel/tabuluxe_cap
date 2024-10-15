<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Contest;
use App\Models\Round;
use App\Models\Score;

class CriteriaController extends Controller
{
    public function store(Request $request, Round $round, Contest $contest) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'weight' => 'numeric|required',
        ]);

        $criteria=Criteria::create([
            'name' => $request->name,
            'description' => $request->description,
            'weight' => $request->weight,
            'round_id' => $round->id
        ]);

        foreach($round->contestants as $contestant) {
            foreach($round->contest->judges as $judge) {
                Score::create([
                    'contestant_id' => $contestant->id,
                    'criteria_id' => $criteria->id,
                    'judge_id' => $judge->id,
                ]);
            }
        }

        // foreach($round->contest->judges as $judge) {
        //     foreach($round->criterias as $criteria) {
        //             Score::create([
        //                 'contestant_id' => $contestant->id,
        //                 'criteria_id' => $criteria->id,
        //                 'judge_id' => $judge->id,
        //             ]);
        //     }
        // }

        // if ($contest->dancesports) {
        //     return redirect('/dancesports/' . $contest->id)->with('Info', 'A criteria has been added.');
        // } else {
        return redirect('/rounds/'. $round->id . '/' . $contest->id)->with('Info', 'A criteria has been added.');
        // }
    }

    public function show(Criteria $criteria) {
        $summary = [];

        $count = 0;
        $highestAve = 0;

        foreach($criteria->round->contestants as $cnt) {
            $sum = 0;
            $summary[$cnt->id]['contestant'] = $cnt;
            foreach($judges = $criteria->round->contest->judges as $judge) {
                $score = Score::get($judge->id, $criteria->id, $cnt->id)->score;
                $sum += $score;
                $summary[$cnt->id]['scores'][] = $score;
            }
            $ave = $sum/count($judges);
            if($ave > $highestAve) {
                $highestAve = $ave;
            }
            $summary[$cnt->id]['average'] = number_format($ave,2);
        }

        return view('criterias.show', [
            'criteria' => $criteria,
            'summary' => $summary,
            'highestRow' => number_format($highestAve, 2)
        ]);
    }

    public function update(Criteria $criteria, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'weight' => 'numeric|required'
        ]);



        $criteria->update($request->only('name','description','weight'));

        return redirect('/contests/' . $criteria->contest_id)->with('Info','Criteria ' . $criteria->name . ' has been updated.');
    }

    public function destroy($id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();
        return redirect('/rounds/' . $criteria->round->id . '/' . $criteria->round->contest->id)->with('Info', 'Deleted Successfully.');

    }
}
