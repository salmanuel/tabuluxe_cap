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
        // foreach($this->contest->judges as $judge) {
        //     $scores = [];
        //     foreach($this->contestants as $cont) {
        //         $scores[] = $cont->getTotalScore($judge);
        //     }

        //     foreach($this->contestants as $cont) {
        //         $data[] = [
        //             'judge' => $judge,
        //             'contestant' => $cont,
        //             'rank' => Judge::computeRank($scores, $cont->getTotalScore($judge), $scores, true)
        //         ];
        //     }
        // }
        // return $data;
        foreach($this->contestants as $cont) {
            $totalRanks = 0;
            foreach($this->contest->judges as $judge) {
                $totalRanks += $judge->rank($cont);
            }
            $data[] = [
                'contestant'=>$cont,
                'sumOfRanks' => $totalRanks
            ];
        }

        return $data;
    }
}
