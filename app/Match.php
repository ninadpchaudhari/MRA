<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //Dates
    protected $dates = ['start_date', 'end_date'];
    protected $fillable = ['name', 'place', 'start_date', 'end_date', 'short_name', 'year'];

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::parse($date);
        //$this->attributes['start_date'] = Carbon::createFromFormat('d-m-Y', $date);
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon::parse($date);
        //$this->attributes['end_date'] = Carbon::createFromFormat('d-m-Y', $date);
    }

    //Match Has many Events
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
