<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Judge;
use App\Models\Score;
use App\Models\SessionModel;

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

        // if ($request->session()->has('simple-judging-access-token')) {
        //     // If a judge is already logged in, prevent login
        //     return back()->with('Error', 'Another judge is already logged in.');
        // }
        $existingSession = SessionModel::where('judge_id', $judge->id)->first();

        if ($existingSession) {
            // If a session for the judge already exists, prevent login
            return back()->with('Error', 'Judge is already logged in.');
        }

        $request->session()->regenerate();

        $request->session()->put('simple-judging-access-token', $judge->access_token);
        // $request->session()->put('judge_id', $judge->id);

        SessionModel::create([
            'id' => $request->session()->getId(),
            'judge_id' => $judge->id,
            'payload' => '',
            'last_activity' => time(),
        ]);

        return redirect('/judging/scoresheet');
    }

    public function scoreSheet() {
        $token = request()->session()->get('simple-judging-access-token');

        if(!$token) return redirect('/judging');

        $judge = Judge::where('access_token', $token)->first();
        // dd($judge->contest->getActiveRound());

        return view('judging.scoresheet',[
            'judge' => $judge
        ]);
    }

    public function save(Request $request) {
        $token = request()->session()->get('simple-judging-access-token');

        if(!$token) return redirect('/judging')->with('Error','You have been logged out. Your recent submission has not been saved.');

        foreach($request->score as $criteria_id=>$criteria) {
            foreach($criteria as $contestant_id=>$score) {
                $score = Score::where('judge_id', $request->judge_id)
                        ->where('criteria_id',$criteria_id)
                        ->where('contestant_id', $contestant_id)
                        ->first()
                        ->update([
                            'score' => $score
                        ]);
                        
                $judge = Judge::find($request->judge_id);
                $contestant = Contestant::find($contestant_id);
                $log_entry = "Judge " . $judge->name . " saved a score of the contestant #" . $contestant->number . " " . $contestant->name ." at " . Carbon::now()->isoFormat('dddd, MMMM Do YYYY, h:mm');
                event(new UserLog($log_entry));
            }
        }

        return redirect('/judging/scoresheet')->with('Info', 'Scores updated at ' .
            Carbon::now()->isoFormat('dddd, MMMM Do YYYY, h:mm'));
    }

    public function logout() {
        $sessionId = request()->session()->getId();
        if ($sessionId) {
            // Retrieve the session entry and delete the entire row from the database
            SessionModel::where('id', $sessionId)->delete();
        }
        request()->session()->forget('simple-judging-access-token');
        return redirect('/judging');
    }
}
