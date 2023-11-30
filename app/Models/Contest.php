<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'schedule', 'event_id', 'computation', 'venue', 'dancesports'
    ];

    public function judges() {
        return $this->hasMany('App\Models\Judge');
    }

    public function contestants() {
        return $this->hasMany('App\Models\Contestant')->orderBy('number');
    }

    public function criterias() {
        return $this->hasMany('App\Models\Criteria');
    }

    public function rounds() {
        return $this->hasMany('App\Models\Round');
    }

    public function event() {
        return $this->belongsTo('App\Models\Event');
    }

    public function nextContestantNumber() {
        $contestant = Contestant::where('contest_id', $this->id)
        ->orderBy('number','desc')->first();

        return $contestant ? $contestant->number + 1 : 1;
    }
}
