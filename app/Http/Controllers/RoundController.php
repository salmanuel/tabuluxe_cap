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
        if($contest->computation === "Ranking") {
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

        } else {
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
                $row[] = $totalScores;

                $formattedAverageScore = number_format($averageScore, 2) . ' %';
                $row['averageScore'] = $formattedAverageScore;


                $computation[$contestant->id] = $row;
                $allAverageScores[$contestant->id] = $averageScore;
            }


            arsort($allAverageScores);


            // $rank = 1;
            // foreach ($allAverageScores as $contestantId => $averageScore) {
            //     $computation[$contestantId]['finalRank'] = $rank;
            //     $rank++;
            // }
        };
        

        

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
        return view('rounds.edit', [
            'round' => $round
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Round $round, Request $request) {
        $request->validate([
            'number' => 'string|required',
            'description' => 'string|required',
        ]);

        $round->update($request->only('number','description'));

        return redirect('/contests/' . $round->contest->id)->with('Info','The details of round ' . $round->name . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $round = Round::findOrFail($id);
        $round->delete();
        return redirect('/contests/' . $round->contest->id)->with('Info', 'Deleted Successfully.');
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

            foreach($round->contest->judges as $judge) {
                foreach($round->criterias as $criteria) {
                        Score::create([
                            'contestant_id' => $cnt->id,
                            'criteria_id' => $criteria->id,
                            'judge_id' => $judge->id,
                        ]);
                }
            }
        }

        return redirect('/rounds/' . $round->id . '/' . $contest->id);
    }
}
