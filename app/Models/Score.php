<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['contestant_id', 'criteria_id', 'judge_id', 'round_id', 'score'];

    public static function judgeTotal($judgeId, $contestantId) {
        return Score::where('judge_id', $judgeId)
            ->where('contestant_id', $contestantId)
            ->pluck('score')
            ->sum();
    }

    public static function get($judge, $criteria, $contestant) {
        return Score::where('judge_id', $judge)
                ->where('criteria_id', $criteria)
                ->where('contestant_id', $contestant)
                ->first();
    }

    public static function computeNormalizedAverage($scores) {
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
