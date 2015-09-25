<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    //Score belongs to an athlete
    protected $fillable =['match_id','event_id'];

    public function athlete(){
        return $this->belongsTo('App\Athlete','athlete_id','athlete_id');
    }
    public function event(){
        return $this->belongsTo('App\Event');
    }

}
