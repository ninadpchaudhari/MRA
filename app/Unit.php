<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }
    public function setAbbreviationAttribute($abbreviation){
        $this->attributes['abbreviation'] = strtolower($abbreviation);
    }
    public function setAssociationNameAttribute($association_name){
        $this->attributes['association_name'] = strtolower($association_name);
    }


    public function getNameAttribute($name){
        return ucfirst($name);
    }
    public function getAbbreviationAttribute($abbreviation){
        return strtoupper($abbreviation);
    }
    public function getAssociationNameAttribute($association_name){
        return ucwords($association_name);
    }
}
