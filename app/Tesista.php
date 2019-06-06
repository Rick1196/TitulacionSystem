<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesista extends Model
{
    protected $table = 'sustentantes';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
