<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function contest() {
    //     return $this->belongsTo(Contest::class);
    // }

    // public function event() {
    //     return $this->belongsTo(Event::class);
    // }

    public function score() {
        return $this->belongsTo(Score::class);
    }

    public function judge() {
        return $this->belongsTo(Judge::class);
    }

    public function contestant() {
        return $this->belongsTo(Contestant::class);
    }
}
