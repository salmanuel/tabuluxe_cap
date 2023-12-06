<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Round;
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
            'dancesports' => true
        ]);

        $round = Round::create([
            'contest_id' => $contest->id,
            'number' => $request->number,
            'description' => $request->description,
        ]);
        
        if($contest->title = 'Latin') {
            $latins = [
                [
                    'name' => 'Cha Cha',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'name' => 'Samba',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'name' => 'Rumba',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'name' => 'Paso Doble',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'name' => 'Jive',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],

            ];
            foreach($latins as $latin) {
                Criteria::create($latin);
            }
            // Criteria::create([
            //     'name' => ''
            // ]);
        }else{
            $standard = [
                [
                    'name' => 'Slow Waltz',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'Tango',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'Viennese Waltz',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'Foxtrot',
                    'description' => 'Dance',
                    'round_id' => $round->id
                ],
                [
                    'Quickstep',
                    'description' => 'Dance',
                    'round_id' => $round->id

                ]
            ];
            foreach($standard as $stndrd) {
                Criteria::create($stndrd);
            }
        }
        

        return redirect('/dancesports/')->with('Info', 'A new dancesport contest has been created.');

    }

    public function show(Contest $contest) {

        $computation = [];


        $allSumOfRanks=[];

        foreach($contest->contestants as $contestant) {
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

        foreach($contest->contestants as $contestant) {
            $computation[$contestant->id]['finalRank'] = Judge::computeRank($allSumOfRanks, $computation[$contestant->id]['sumOfRank'],false);
        }

        $rounds = $contest->rounds;

        return view('dancesports.show', [
            'contest' => $contest,
            'computation' => $computation,
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
