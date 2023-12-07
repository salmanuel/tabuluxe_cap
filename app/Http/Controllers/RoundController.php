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

        $round=Round::create([
            'number' => $request->number,
            'description' => $request->description,
            'contest_id' => $contest->id,
        ]);

        if ($prevRound) {
            $prevRound->next_round_id = $round->id;
            $prevRound->save();
        }

        return redirect('/contests/' . $contest->id)->with('Info','A new Round has been added.');

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

            // Calculate the average score
            $averageScore = count($contest->judges) > 0 ? $totalScores / count($contest->judges) : 0;
            $row['averageScore'] = $averageScore;

            $computation[$contestant->id] = $row;
            $allAverageScores[] = $averageScore;
        }

        foreach ($round->contestants as $contestant) {
            // Compute the final average rank
            $computation[$contestant->id]['finalAverageScore'] = Judge::computeRank($allAverageScores, $computation[$contestant->id]['averageScore'], false);
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

        return view('rounds/selection',[
            'data' => $data,
            'round'=>$round,
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
    public function update(Request $request, Round $round)
    {
        //
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

    public function startNextRound(Round $round, Request $request) {
        $contest = $round->contest;

        $contest->active_round = $round->id;
        $contest->save();

        foreach($request->check as $index=>$check) {
            $name = $request->name[$index];
            $remarks = $request->remarks[$index];
            $number = $request->number[$index];

            $cnt = Contestant::create([
                'name' => $name,
                'number' => $number,
                'remarks' => $remarks,
                'round_id' => $round->id
            ]);
        }

        return redirect('/rounds/' . $round->id . '/' . $contest->id);
    }
}
