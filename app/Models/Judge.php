<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'passcode', 'contest_id','access_token'];

    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }

    public function score($criteriaId, $contestantId) {
        return Score::where('judge_id', $this->id)
                ->where('contestant_id', $contestantId)
                ->where('criteria_id', $criteriaId)
                ->first();
    }

    public function rank(Contestant $contestant) {
        $totals = [];
        $ranks = [];
        foreach($contestant->round->contestants as $cont) {
            $totals[] = Score::judgeTotal($this->id, $cont->id);
        }

        return static::computeRank($totals, Score::judgeTotal($this->id, $contestant->id), true);
    }

    public static function computeRank(array $scores, $theScore, $descending) {
        if($descending) rsort($scores);
        else sort($scores);

        $ranks = [];
        $rank = 1;
        $prev = $scores[0];

        foreach($scores as $score) {
            if($prev!=$score) {
                $prev=$score;
                $rank++;
            }
            $ranks[$score] = $rank;
        }

        return $ranks[$theScore];
    }
}
