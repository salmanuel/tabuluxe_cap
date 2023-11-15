<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','weight', 'contest_id'];

    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }
}
