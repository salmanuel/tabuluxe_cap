<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Round;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ContestController extends Controller
{
    public function index($eventId) {
        $contests = Contest::where('event_id', $eventId)->get();
        $event = Event::findOrFail($eventId);

        return view('contests.index',[
            'contests' => $contests,
            'eventId' => $eventId,
            'event' => $event,
        ]);
    }

    public function create($eventId) {
        return view('contests.create', ['eventId' => $eventId]);
    }

    public function store(Request $request, $eventId) {
        $request->validate([
            'title'         => 'string|required',
            'schedule'      => 'string|required',
            'venue'         => 'string|required',
            'computation'   => 'string|required',
            'number'        => 'numeric|required',
            'description'   => 'string|required'
        ]);

        $contest = Contest::create([
            'title'         => $request->title,
            'schedule'      => $request->schedule,
            'venue'         => $request->venue,
            'computation'   => $request->computation,
            'event_id'      => $eventId,
        ]);

        $round = Round::create([
            'contest_id' => $contest->id,
            'number' => $request->number,
            'description' => $request->description,
        ]);

        $contest = $round->contest;

        $contest->active_round = $round->id;
        $contest->save();

        return redirect('/events/' . $contest->event_id . '/contests')->with('Info', 'A new contest has been created.');
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

        return view('contests.show', [
            'contest' => $contest,
            // 'computation' => $computation,
            'rounds' => $rounds

        ]);
    }

    public function edit($id)
    {
        $contests = Contest::findOrFail($id);
        $events = Event::where('id')->get();
        return view('contests.edit-contest', compact('contests, events'));
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

        return redirect('/events/' . $contest->event_id . '/contests')->with('Info', 'Updated Successfully.');
    }

    public function destroy($id)
    {
        $contest = Contest::findOrFail($id);
        $contest->delete();
        return redirect('/events/' . $contest->event_id . '/contests')->with('Info', 'Deleted Successfully.');
    }

}
