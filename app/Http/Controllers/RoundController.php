<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Round;
use App\Models\Score;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // return redirect('/contests/' . $contest->id)->with('Info','A new Round has been added.');
        if ($contest->dancesports) {
            return redirect('/dancesports/' . $contest->id)->with('Info', 'A round has been added.');
        } else {
            return redirect('/contests/'. $contest->id)->with('Info', 'A round has been added.');
        }

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
        if($contest->computation === "Ranking") {


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

        }else if($contest->computation=="Complex") {
            $idx  = 0;
            foreach($round->contestants as $cont) {
                $row = [];
                $row[] = $cont;

                $scores = [];
                foreach($round->contest->judges as $judge) {
                    $tot = Score::where('judge_id', $judge->id)
                            ->where('contestant_id', $cont->id)
                            ->sum('score');
                    $scores[] = $tot;
                    $row[] = $tot;
                }
                $row[] = Score::computeNormalizedAverage($scores);

                $computation[] = $row;
            }
        }else {
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

    public function pdf(Round $round, Contest $contest) {
        $computation = [];
        if($contest->computation === "Ranking") {


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

        }else if($contest->computation=="Complex") {
            $idx  = 0;
            foreach($round->contestants as $cont) {
                $row = [];
                $row[] = $cont;

                $scores = [];
                foreach($round->contest->judges as $judge) {
                    $tot = Score::where('judge_id', $judge->id)
                            ->where('contestant_id', $cont->id)
                            ->sum('score');
                    $scores[] = $tot;
                    $row[] = $tot;
                }
                $row[] = Score::computeNormalizedAverage($scores);

                $computation[] = $row;
            }
        }else {
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

        $pdf = Pdf::loadView('pdf.ranking',[
            'round' => $round,
            'contest' => $contest,
            'computation' => $computation,
            'judges' => $judges
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function select(Round $round, Contest $contest)
    {
        $data = $round->computeOverall();
        // $overallAverages = $round->computeOverall();

        // dd($data);

        return view('rounds/selection',[
            'data' => $data,
            // 'overallAverages' => $overallAverages,
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
            // 'number' => 'numeric|required',
            // 'number' => 'numeric|required|unique:rounds,number,NULL,id,contest_id,' . $round->contest->id,

            'description' => 'string|required',
        ]);

        $round->update($request->only('description'));

        if($round->contest->dancesports) {
            return redirect('/dancesports/' . $round->contest->id)->with('Info','The details of round ' . $round->name . ' has been updated.');
        }else {
            return redirect('/contests/' . $round->contest->id)->with('Info','The details of round ' . $round->name . ' has been updated.');
        }
    }

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

        if($contest->title === 'Latin') {
            $latins = [
                [
                    'name' => 'Cha Cha',
                    'description' => 'One of the five main Latin ballroom dances most frequently taught in dance schools around the world.',
                    'round_id' => $round->id,
                    'weight' => 10
                ],
                [
                    'name' => 'Samba',
                    'description' => 'Ballroom dance of Brazilian origin, popularized in western Europe and the United States in the early 1940s.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Rumba',
                    'description' => 'Ballroom dance of Afro-Cuban folk-dance origin that became internationally popular in the early 20th century.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Paso Doble',
                    'description' => 'The term “paso doble” means “double step” or “two-step” in Spanish',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Jive',
                    'description' => 'An energetic, upbeat partner dance with one partner leading and the other following.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],

            ];
            foreach($latins as $latin) {
                $criteria = Criteria::create($latin);
            }

            foreach($round->contestants as $contestant) {
                foreach($round->contest->judges as $judge) {
                    Score::create([
                        'contestant_id' => $contestant->id,
                        'criteria_id' => $criteria->id,
                        'judge_id' => $judge->id,
                    ]);
                }
            }
            // Criteria::create([
            //     'name' => ''
            // ]);
        }else if($contest->title === 'Standard') {
            $standard = [
                [
                    'name' => 'Slow Waltz',
                    'description' => 'The Slow Waltz is danced with 28-30 beats per minute.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Tango',
                    'description' => 'Characterized by a close hold, a low center of gravity and an emphasis on Contra Body movement.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Viennese Waltz',
                    'description' => 'Originally a folk dance in rural Austria and Germany.',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Foxtrot',
                    'description' => 'A smooth dance where the dancers travel across the dance floor',
                    'round_id' => $round->id,
                    'weight' => 10

                ],
                [
                    'name' => 'Quickstep',
                    'description' => 'The quickstep is a light-hearted dance of the standard ballroom dances.',
                    'round_id' => $round->id,
                    'weight' => 10


                ]
            ];
            foreach($standard as $stndrd) {
                $criteria = Criteria::create($stndrd);
            }

            foreach($round->contestants as $contestant) {
                foreach($round->contest->judges as $judge) {
                    Score::create([
                        'contestant_id' => $contestant->id,
                        'criteria_id' => $criteria->id,
                        'judge_id' => $judge->id,
                    ]);
                }
            }
        }

        return redirect('/rounds/' . $round->id . '/' . $contest->id);
    }
}
