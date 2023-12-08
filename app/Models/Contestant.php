<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Judge;
use App\Models\Score;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'number', 'remarks', 'round_id'
    ];

    public function round() {
        return $this->belongsTo('App\Models\Round');
    }

    public function scoresFromJudge(Judge $judge) {
        return Score::where('judge_id', $judge->id)
                ->where('round_id', $this->id)
                ->get();
    }

    public function score($judgeId, $criteriaId) {
        return Score::where('contestant_id', $this->id)
                ->where('judge_id', $judgeId)
                ->where('criteria_id', $criteriaId)
                ->first();
    }

    public function getTotalScore(Judge $judge) {
        return Score::where('judge_id', $judge->id)
                ->where('contestant_id', $this->id)
                ->sum('score');
    }

    public function getNormalizedAverage() {
        $scores = [];
        foreach($this->round->contest->judges as $judge) {
            $s = Score::where('judge_id', $judge->id)
                    ->where('contestant_id', $this->id)
                    ->sum('score');
            $scores[] = $s;
        }

        sort($scores);

        $len = count($scores);

        unset($scores[0]);
        unset($scores[$len-1]);
        $scores = array_values($scores);

        //compute sum of remaining
        $sum = 0;
        foreach($scores as $s) $sum+=$s;

        return $sum/($len-2);
    }
}
