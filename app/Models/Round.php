<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contestants() {
        return $this->hasMany('App\Models\Contestant');
    }

    public function criterias() {
        return $this->hasMany('App\Models\Criteria');
    }

    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }

    public function computeOverall() {
        //ranking system
        $data = [];
        if($this->contest->computation === 'Ranking') {

            foreach($this->contestants as $cont) {
                $totalRanks = 0;
                foreach($this->contest->judges as $judge) {
                    $totalRanks += $judge->rank($cont);
                }
                $data[] = [
                    'contestant'=>$cont,
                    'sumOfRanks' => $totalRanks
                ];

                $data = collect($data)->sortByDesc('sumOfRanks')->values()->all();

            }

            return $data;
        } else  {
            // $data = [];

            foreach ($this->contestants as $cont) {
                $totalScores = 0;
    
                foreach ($this->contest->judges as $judge) {
                    $score = \App\Models\Score::judgeTotal($judge->id, $cont->id);
                    $totalScores += $score;
                }
    
                // $averageScore = count($this->contest->judges) > 0 ? $totalScores / count($this->contest->judges) : 0;
                $averageScore = count($this->contest->judges) > 0 ? number_format($totalScores / count($this->contest->judges), 2) . ' %' : '0.00 %';

                $data[] = [
                    'contestant' => $cont,
                    'averageScore' => $averageScore
                ];

                $data = collect($data)->sortByDesc('averageScore')->values()->all();
            }

        } 
        return $data;
    }
}
