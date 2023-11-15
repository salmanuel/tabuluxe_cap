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
        'name', 'number', 'remarks', 'contest_id'
    ];

    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }

    public function scoresFromJudge(Judge $judge) {
        return Score::where('judge_id', $judge->id)
                ->where('contestant_id', $this->id)
                ->get();
    }

    public function score($judgeId, $criteriaId) {
        return Score::where('contestant_id', $this->id)
                ->where('judge_id', $judgeId)
                ->where('criteria_id', $criteriaId)
                ->first();
    }
}
