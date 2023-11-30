<?php

namespace App\Http\Controllers;

use App\Models\Contest;
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
            'rounds' => 'numeric|required|unique:rounds,rounds,NULL,id,contest_id,' . $contest->id,
            'no_of_contestants' => 'string|required',
        ]);

        $round=Round::create([
            'rounds' => $request->rounds,
            'no_of_contestants' => $request->no_of_contestants,
            'contest_id' => $contest->id
        ]);

        foreach($contest->contestants as $contestant) {
            foreach($contest->criterias as $criteria) {
                foreach($contest->judges as $judge) {
                    Score::create([
                        'contestant_id' => $contestant->id,
                        'criteria_id' => $criteria->id,
                        'judge_id' => $judge->id,
                        'round_id' => $round->id
                    ]);
                }
            }
        }

        return redirect('/contests/' . $contest->id)->with('Info','A new Round has been added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round)
    {
        //
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
