<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Contest;
use App\Models\Judge;
use App\Models\Score;
use App\Models\SessionModel;

class JudgeController extends Controller
{
    public function store(Request $request, Contest $contest) {
        $request->validate([
            'name' => 'string|required',
            'passcode' => 'string|required|unique:judges',
        ]);

        $judge=Judge::create([
            'name' => $request->name,
            'passcode' => $request->passcode,
            // 'password' => Crypt::encryptString($request->pass_code),
            // 'passcode' => bcrypt($request->pass_code),
            'contest_id' => $contest->id,
            'access_token' => Str::random(64)
        ]);

        foreach($contest->rounds as $round) {
            foreach($round->contestants as $cont) {
                foreach($round->criterias as $crit) {
                    Score::create([
                        'contestant_id' => $cont->id,
                        'judge_id' => $judge->id,
                        'criteria_id' => $crit->id,
                        'score' => 0
                    ]);
                }
            }
        }

        // return redirect('/contests/' . $contest->id)->with('Info','A new Judge has been created.');
        if ($contest->dancesports) {
            return redirect('/dancesports/' . $contest->id)->with('Info', 'A new Judge has been created.');
        } else {
            return redirect('/contests/' . $contest->id)->with('Info', 'A new Judge has been created.');
        }

    }

    public function show(Judge $judge) {
        return view('judges.show', [
            'judge' => $judge
        ]);
    }

    public function update(Judge $judge, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'passcode' => 'string|required',
        ]);

        $judge->update($request->only('name','passcode'));

        return redirect('/contests/' . $judge->contest_id)->with('Info','The details of judge ' . $judge->name . ' has been updated.');
    }

    public function destroy($id)
    {
        $judge = Judge::findOrFail($id);
        $id = $judge->id;
        $judge->delete();
        Score::where('judge_id', $id)->delete();
        return redirect('/contests/' . $judge->contest->id)->with('Info', 'Deleted Successfully.');
    }

    public function deleteSession(Judge $judge) {
        SessionModel::where('judge_id', $judge->id)
                ->delete();
        return back()->with('Info',"The judge's session has been deleted.");
    }
}
