<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','weight', 'round_id'];

    public function round() {
        return $this->belongsTo('App\Models\Round');
    }

    public function contestants() {
        return $this->hasMany('App\Models\Contestant');
    }
}
