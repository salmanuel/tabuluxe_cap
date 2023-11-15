<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Judge;
use App\Models\Score;

class JudgingController extends Controller
{
    public function index() {
        $token = request()->session()->get('simple-judging-access-token');

        if($token) return redirect('/judging/scoresheet');

        return view('judging.index');
    }

    public function login(Request $request) {
        $judge = Judge::where('passcode', $request->passcode)->first();

        if(!$judge) return back()->with('Error','Invalid pass code.');

        $request->session()->put('simple-judging-access-token', $judge->access_token);

        return redirect('/judging/scoresheet');
    }

    public function scoreSheet() {
        $token = request()->session()->get('simple-judging-access-token');

        if(!$token) return redirect('/judging');

        $judge = Judge::where('access_token', $token)->first();

        return view('judging.scoresheet',[
            'judge' => $judge
        ]);
    }

    public function save(Request $request) {
        $token = request()->session()->get('simple-judging-access-token');

        if(!$token) return redirect('/judging')->with('Error','You have been logged out. Your recent submission has not been saved.');

        foreach($request->score as $criteria_id=>$criteria) {
            foreach($criteria as $contestant_id=>$score) {
                Score::where('judge_id', $request->judge_id)
                        ->where('criteria_id',$criteria_id)
                        ->where('contestant_id', $contestant_id)
                        ->first()
                        ->update([
                            'score' => $score
                        ]);
            }
        }

        return redirect('/judging/scoresheet')->with('Info', 'Scores updated at ' .
            Carbon::now()->isoFormat('dddd, MMMM Do YYYY, h:mm'));
    }

    public function logout() {
        request()->session()->forget('simple-judging-access-token');
        return redirect('/judging');
    }
}
