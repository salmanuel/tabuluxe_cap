<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Judge;
use App\Models\Round;
use App\Models\Score;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contest $contest)
    {
        $request->validate([
            'number' => 'numeric|required|unique:rounds,number,NULL,id,contest_id,' . $contest->id,
            'description' => 'string|required',
        ]);

        $prevRound = $contest->getLastRound();

        $round = Round::create([
            'number' => $request->number,
            'description' => $request->description,
            'contest_id' => $contest->id,
        ]);

        // $contest = $round->contest;

        // $contest->active_round = $round->id;
        // $contest->save();

        if ($prevRound) {
            $prevRound->next_round_id = $round->id;
            $prevRound->save();
        }

        return redirect('/contests/' . $contest->id)->with('Info', 'A new Round has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round, Contest $contest)
    {
        $computation = [];
        $allAverageScores = [];

        foreach ($round->contestants as $contestant) {
            $row = [];
            $row[] = "#" . $contestant->number . " " . $contestant->name . ($contestant->remarks ? "<br/>" . $contestant->remarks : "");

            $totalScores = 0;

            foreach ($contest->judges as $judge) {
                $score = \App\Models\Score::judgeTotal($judge->id, $contestant->id);
                $row[] = $score;
                $totalScores += $score;
            }


            $averageScore = count($contest->judges) > 0 ? $totalScores / count($contest->judges) : 0;
            $row['averageScore'] = $averageScore;

            $computation[$contestant->id] = $row;
            $allAverageScores[$contestant->id] = $averageScore;
        }


        arsort($allAverageScores);


        $rank = 1;
        foreach ($allAverageScores as $contestantId => $averageScore) {
            $computation[$contestantId]['finalRank'] = $rank;
            $rank++;
        }

        $judges = $contest->judges;

        return view('rounds.show', [
            'round' => $round,
            'computation' => $computation,
            'contest' => $contest,
            'judges' => $judges
        ]);
    }

    public function select(Round $round, Contest $contest)
    {
        $data = $round->computeOverall();

        // dd($data);

        return view('rounds/selection', [
            'data' => $data,
            'round' => $round,
            'contest' => $contest
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Contest $contest)
    {
        $validatedData = $request->validate([
            'number' => 'string|required',
            'description' => 'string|required',

        ]);

        $round = Round::findOrFail($id);
        $round->number = $validatedData['number'];
        $round->description = $validatedData['description'];
        // $round->event_id = $eventId;
        $round->save();

        return redirect('/contests/' . $contest->id . '/contests')->with('Info', 'Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Round $round)
    {
        //
    }
    

    public function startNextRound(Round $round, Request $request)
    {
        $contest = $round->contest;

        $contest->active_round = $round->id;
        $contest->save();

        foreach ($request->check as $index => $check) {
            $name = $request->name[$index];
            $remarks = $request->remarks[$index];
            $number = $request->number[$index];

            $cnt = Contestant::create([
                'name' => $name,
                'number' => $number,
                'remarks' => $remarks,
                'round_id' => $round->id
            ]);

            foreach($round->criterias as $crit) {
                foreach($round->contest->judges as $judge){
                    Score::create([
                        'judge_id' => $judge->id,
                        'criteria_id' => $crit->id,
                        'contestant_id' => $cnt->id
                    ]);
                }
            }
        }

        return redirect('/rounds/' . $round->id . '/' . $contest->id);
    }
}
