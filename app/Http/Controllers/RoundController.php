<?php

namespace App\Http\Controllers;

use App\Models\Contest;
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

        $round=Round::create([
            'number' => $request->number,
            'description' => $request->description,
            'contest_id' => $contest->id,
        ]);

        
        $prevRound = $contest->getLastRound();

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


        $allSumOfRanks=[];

        foreach($round->contestants as $contestant) {
            $row = [];
            $row[] = "#" . $contestant->number . " " . $contestant->name . ($contestant->remarks ? "<br/>" . $contestant->remarks : "");
            $sumOfRanks=0;

            foreach($contest->judges as $judge) {
                $row[] = \App\Models\Score::judgeTotal($judge->id, $contestant->id);
                $row[] = $rank = $judge->rank($contestant);
                $sumOfRanks += $rank;

                // $decryptedPasscode = Crypt::decryptString($judge->password);
                // $judge->setAttribute('decryptedPasscode', $decryptedPasscode);
            }

            $row['sumOfRank'] = $sumOfRanks;

            $allSumOfRanks[] = $sumOfRanks;
            $computation[$contestant->id] = $row;
        }

        foreach($round->contestants as $contestant) {
            $computation[$contestant->id]['finalRank'] = Judge::computeRank($allSumOfRanks, $computation[$contestant->id]['sumOfRank'],false);
        }

        $judges = $contest->judges;

        return view('rounds.show', [
            'round' => $round,
            'computation' => $computation,
            'contest' => $contest,
            'judges' => $judges
        ]);
    }

    public function nextRound(Round $round) 
    {
        return view('/rounds' . $round->next_round_id);
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
}
