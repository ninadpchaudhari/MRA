<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Comparator\ArrayComparatorTest;

class Event extends Model
{
    //
    protected $fillable = [
        'match_id',
        'name',
        'class',
        'type',
        'gender',
        'nat_civil',
        'category',
        'issf_qualification_score',
        'nr_qualification_score',
        'isDecimal',
        'max_score',
        'consider_for_qualification'
    ];

    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }


    public function scopeForMatch($query, $match_id)
    {
        return $query->where('match_id', $match_id);
    }

    public function scopeForClasses($query, $playableClasses)
    {
        return $query->where('classes', 'in', $playableClasses);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtoupper($name);
    }

    public function setClassAttribute($class)
    {
        if (in_array($class, array_get(\App\Event::decodeArray(), 'classes'))) {
            $this->attributes['class'] = $class;
        } else return "error";
    }

    public function setTypeAttribute($type)
    {
        if (in_array($type, array_get(\App\Event::decodeArray(), 'types'))) {
            $this->attributes['type'] = $type;
        } else return "error";
    }

    public function setGenderAttribute($gender)
    {
        if (in_array($gender, array_get(\App\Event::decodeArray(), 'genders'))) {
            $this->attributes['gender'] = $gender;
        } else return "error";
    }

    public function setNatCivilAttribute($nat_civil)
    {
        if (in_array($nat_civil, array_get(\App\Event::decodeArray(), 'nat_civil'))) {
            $this->attributes['nat_civil'] = $nat_civil;
        } else return "error";
    }

    public function setCategoryAttribute($category)
    {
        if (in_array($category, array_get(\App\Event::decodeArray(), 'categories'))) {
            $this->attributes['category'] = $category;
        } else return "error";
    }

    public static function decodeArray()
    {
        return
            Array(
                ('classes') => Array(
                    '10M Rifle',
                    '10M Pistol',
                    '50M Rifle 3 Position',
                    '50M Rifle Prone',
                    '25M Center Fire Pistol',
                    '25M Rapid Fire Pistol',
                    '25M Pistol',
                    '25M Standard Pistol',
                    '50M Pistol',
                    'Clay Pigeon Trap',
                    'Clay Pigeon Double Trap',
                    'Clay Pigeon Skeet',
                ),
                ('categories') => Array(
                    'Senior',
                    'Junior',
                    'Youth',
                    'Handicapped',
                    'Veterans',
                    'Services',
                    'Junior Services',
                    'MQS'
                ),
                ('nat_civil') => Array(
                    'National',
                    'Civilian',
                    '-'
                ),
                ('types') => Array(
                    'ISSF',
                    'NR',
                    'FOREIGN NATIONAL'
                ),
                ('genders') => Array(
                    'Men',
                    'Women',
                    'Common'
                )

            );

    }
    public static function decodeArrayForMatch_id($match_id){
        $decodeArray = \App\Event::decodeArray();
        $classes = \App\Event::where('match_id',$match_id)->distinct()->lists('class')->toArray();
        $genders = \App\Event::where('match_id',$match_id)->distinct()->lists('gender')->toArray();
        $categories = \App\Event::where('match_id',$match_id)->distinct()->lists('category')->toArray();
        $types = \App\Event::where('match_id',$match_id)->distinct()->lists('type')->toArray();

        foreach($decodeArray['classes'] as $classKey => $classValue){
            if(in_array($classValue,$classes))  continue;
            else unset($decodeArray['classes'][$classKey]);
        }
        foreach($decodeArray['genders'] as $genderKey=>$genderValue){
            if(in_array($genderValue,$genders))  continue;
            else unset($decodeArray['genders'][$genderKey]);
        }
        foreach($decodeArray['categories'] as $categoryKey => $categoryValue){
            if(in_array($categoryValue,$categories))  continue;
            else unset($decodeArray['categories'][$categoryKey]);
        }
        foreach($decodeArray['types'] as $typeKey => $typeValue){
            if(in_array($typeValue,$types))  continue;
            else unset($decodeArray['types'][$typeKey]);
        }
        return $decodeArray;
    }
    public static function decodeEvent($matchName, $requirement)
    {
        print_r($matchName . "\n" . $requirement);
        $decodeArray = \App\Event::decodeArray();
        $requiredArray = array_get($decodeArray, $requirement);
        foreach ($requiredArray as $key => $individualMatchName) {
            if (stripos($matchName, $individualMatchName) !== FALSE) {
                // found
                return $requiredArray[$key];
            }
        }
        if ($requirement == 'nat_civil') return '-';
        if ($requirement == 'genders') return 'Common';
        if ($requirement == 'categories') return 'Senior';
        if ($requirement == 'classes' && strpos($matchName, 'DOUBLE TRAP') !== FALSE)
            return 'Clay Pigeon Double Trap';
        if ($requirement == 'classes' && strpos($matchName, 'SKEET') !== FALSE)
            return 'Clay Pigeon Skeet';
        echo "Error in decoding {$matchName} of {$requirement}";
    }
}
