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
}
