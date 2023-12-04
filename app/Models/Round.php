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
}
