<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinodal extends Model
{
    protected $table = 'evaluadores';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
