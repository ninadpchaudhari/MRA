<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Athlete extends Model
{
    //
    protected $dates = ['DOB'];


    public function scopeGetPublicInfo($query, $shooterID)
    {
        return $query->where('shooterID', $shooterID)->first(array('shooterID',
            'shooterName',
            'motherName',
            'fatherName',
            'state',
            'stateOfRep',
            'eventRifle',
            'eventPistol',
            'eventShotgun',
            'sex'
        ));
    }

    //Athlete has many scores
    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    public function events($match_id, $shooterID)
    {
        return DB::table('events')
            ->join('scores', 'scores.event_id', '=', 'events.id')
            ->select('events.*', 'scores.shooterID')
            ->where(['scores.shooterID' => $shooterID, 'events.match_id' => $match_id])
            ->get();

    }


    //mutators
    public function getShooterIDAttribute($shooterID)
    {
        return strtoupper($shooterID);
    }


}
