<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relay extends Model
{
    //
    protected $fillable = ['match_id','relay_no','startTime','endTime','class','gender','type'];
}
