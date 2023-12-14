<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    use HasFactory;

    protected $table = 'sessions'; // Assuming the table name is 'sessions'

    protected $guarded = [];

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }
}
