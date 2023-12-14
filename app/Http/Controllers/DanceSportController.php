<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Round;
use App\Models\Score;
use Illuminate\Http\Request;

class DanceSportController extends Controller
{
    public function index() {
        $contests = Contest::where('dancesports', true)->get();

        return view('dancesports.index',[
            'contests' => $contests,
        ]);
    }

    public function create() {
        return view('dancesports.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'schedule' => 'string|required',
            'venue' => 'string|required',
            // 'computation' => 'string|required',
        ]);

        $contest = Contest::create([
            'title' => $request->title,
            'schedule' => $request->schedule,
            'venue' => $request->venue,
            'computation' => 'Ranking',
            'dancesports' => true,
            'user_id' => auth()->user()->id
        ]);
        

        $round = Round::create([
            'contest_id' => $contest->id,
            'number' => $request->number,
            'description' => $request->description,
        ]);

        $contest = $round->contest;

        $contest->active_round = $round->id;
        $contest->save();
        
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
        }else{
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
        

        return redirect('/dancesports/')->with('Info', 'A new dancesport contest has been created.');

    }

    public function show(Contest $contest) {

        // $computation = [];


        // $allSumOfRanks=[];

        // foreach($contest->contestants as $contestant) {
        //     $row = [];
        //     $row[] = "#" . $contestant->number . " " . $contestant->name . ($contestant->remarks ? "<br/>" . $contestant->remarks : "");
        //     $sumOfRanks=0;

        //     foreach($contest->judges as $judge) {
        //         $row[] = \App\Models\Score::judgeTotal($judge->id, $contestant->id);
        //         $row[] = $rank = $judge->rank($contestant);
        //         $sumOfRanks += $rank;

        //         // $decryptedPasscode = Crypt::decryptString($judge->password);
        //         // $judge->setAttribute('decryptedPasscode', $decryptedPasscode);
        //     }

        //     $row['sumOfRank'] = $sumOfRanks;

        //     $allSumOfRanks[] = $sumOfRanks;
        //     $computation[$contestant->id] = $row;
        // }

        // foreach($contest->contestants as $contestant) {
        //     $computation[$contestant->id]['finalRank'] = Judge::computeRank($allSumOfRanks, $computation[$contestant->id]['sumOfRank'],false);
        // }

        $rounds = $contest->rounds;

        return view('dancesports.show', [
            'contest' => $contest,
            // 'computation' => $computation,
            'rounds' => $rounds

        ]);
    }

    public function edit($id)
    {
        $contests = Contest::findOrFail($id);
        return view('contests.edit-contest', compact('contests'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'string|required',
            'schedule' => 'string|required',
            'venue' => 'string|required',
            'computation' => 'string|required',

        ]);

        $contest = Contest::findOrFail($id);
        $contest->title = $validatedData['title'];
        $contest->schedule = $validatedData['schedule'];
        $contest->venue = $validatedData['venue'];
        $contest->computation = $validatedData['computation'];
        // $contest->event_id = $eventId;
        $contest->save();

        return redirect('/dancesports/')->with('Info', 'Updated Successfully.');
    }

    public function destroy($id)
    {
        $contest = Contest::findOrFail($id);
        $contest->delete();
        return redirect('/dancesports/')->with('Info', 'Deleted Successfully.');
    }

}
