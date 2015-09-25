<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GFG2015Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        //
        Model::unguard();

        DB::transaction(function(){

            $DBNAME = 'gfg2015';
            //Inporting comMaster => Competition Data

            $compInfo = DB::table($DBNAME.'.compMaster')->first();
            $newInfo['name'] = $compInfo->compName;
            $newInfo['short_name'] = $compInfo->compCode;
            $newInfo['place'] = $compInfo->place;
            $newInfo['start_date'] = $compInfo->dtFr;
            $newInfo['end_date'] = $compInfo->dtTo;
            $newInfo['year'] = 2015;
            // this match_id will be used for adding participations
            $this->command->info(implode('-',$newInfo));
            $match = \App\Match::create($newInfo);
            $this->command->info("Match {$match->name} added");


            //Importing Athletes if any new
            $thisCompAthletes = DB::table($DBNAME.'.shooterm')->select(
                'cardNo','shooterID','idCount','shooterName','motherName','fatherName','address','city','pin','state','education','stateOfRep','eventRifle','eventPistol','eventShotgun','sex','POB','DOB','photoAvail','signAvail','contact','email','provisionalShooter'
            )->get();
            foreach($thisCompAthletes as $thisCompAthlete){



                /**
                 * Checking if the shooter is provisional , If yes
                 * Then making ID as "P_MatchID_shooterID"
                 * and then continue with the loop
                 */
                if($thisCompAthlete->provisionalShooter == '1'){
                    //$this->command->info("Entering provisional Shooter clause for {$thisCompAthlete->shooterID} ");
                    $thisCompAthlete = (array) $thisCompAthlete;
                    //Shooter is Provisional Shooter => append "P_" in front of his ID
                    $old_shooterID = $thisCompAthlete['shooterID'];
                    $thisCompAthlete['shooterID']= 'P_'.(string)$match->id.'_'.$thisCompAthlete['shooterID'];

                    foreach($thisCompAthlete as $key=>$val){
                        if(!isset($val)) $thisCompAthlete[$key] = 'provisional_id';
                    }
                    unset($thisCompAthlete['provisionalShooter']);

                    \App\Athlete::create($thisCompAthlete);
                    DB::table($DBNAME.'.shooterm')
                        ->where('shooterID',$old_shooterID)
                        ->update(['shooterID' => $thisCompAthlete['shooterID']]);
                    DB::table($DBNAME.'.Participation')
                        ->where('shooterID',$old_shooterID)
                        ->update(['shooterID' => $thisCompAthlete['shooterID']]);
                }


                /**
                 * Searching for Athlete with same ID ,
                 * If Found=> Update
                 * Else Create
                 */
                else{
                    $athlete = \App\Athlete::where('shooterID',$thisCompAthlete->shooterID)->first();
                    if($athlete == null){


                        $thisCompAthlete = (array)$thisCompAthlete;

                        unset($thisCompAthlete['provisionalShooter']);


                        \App\Athlete::create($thisCompAthlete);
                    }
                    else{
                        $this->command->info("Updating{$thisCompAthlete->shooterID}");


                        $thisCompAthlete = (array)$thisCompAthlete;
                        unset($thisCompAthlete['provisionalShooter']);

                        $athlete->update($thisCompAthlete);
                    }
                    //Saving Photos
                    // as no photo is there for provisional shooters, this comes in the else clause
                    //Doesnt work ... Throws exception of heap overflow
                    //\App\Athlete::savePhoto($thisCompAthlete['shooterID'],$photo);
                }

            }

            //Importing all Participations for the match
            $participations = DB::table($DBNAME.'.Participation')->select(
                'matchNo','matchName','qlyScore','matchType','shooterID','cptrCode','team','wildcard','participatingState','total','shotgunTotal','FsubTotal','shotgunFinalTotal','Rank'
            )->get();
            $participationsCount = DB::table($DBNAME.'.Participation')->select(
                'matchNo','matchName','qlyScore','matchType','shooterID','cptrCode','team','wildcard','participatingState','total','shotgunTotal','FsubTotal','shotgunFinalTotal','Rank'
            )->count();
            foreach($participations as $participation) {
                $this->command->info("Remaning Participations : {$participationsCount}");
                $event = \App\Event::where(['match_id' => $match->id, 'name' => $participation->matchNo])->first();
                if ($event == null) {

                    $event['match_id'] = $match->id; // FROM the match added before
                    $event['name'] = $participation->matchNo;
                    $this->command->info("On participation loop , eventname : {$event['name']}");
                    $event['class'] = (string)\App\Event::decodeEvent($participation->matchName, 'classes');
                    $event['type'] = \App\Event::decodeEvent($participation->matchName, 'types');
                    $event['gender'] = \App\Event::decodeEvent($participation->matchName, 'genders');
                    $event['nat_civil'] = \App\Event::decodeEvent($participation->matchName, 'nat_civil');
                    $event['category'] = \App\Event::decodeEvent($participation->matchName, 'categories');
                    $event['consider_for_qualification'] = true;
                    echo "\n";
                    print_r($event);
                    $event = \App\Event::create($event);
                    $this->command->info("Event added id: {$event->id}");
                }

                $score['shooterID'] = $participation->shooterID;
                $score['cptrCode'] = $participation->cptrCode;
                if (strcmp($participation->team, 'Y') == 0) $score['inTeam'] = true;
                else $score['inTeam'] = false;
                if (strcmp($participation->wildcard, 'Y') == 0) $score['isWildCard'] = true;
                else $score['isWildCard'] = false;
                $score['event_id'] = $event->id;
                $score['score'] = $participation->total;
                $score['final_score'] = $participation->FsubTotal;
                $unit = \App\Unit::where('name',strtolower($participation->participatingState))->first();

                $score['representing_unit'] = $unit->id;
                $score['verified_by_unit'] = 2;
                if(strcmp($participation->Rank,'-----') != 0 )
                    $score['rank'] = $participation->Rank;
                $score['record'] = null;
                echo "\nScore : " ;

                print_r($score);
                \App\Score::create($score);
                $participationsCount--;
                $event = null;
                $score= null;
            }
            DB::update('update '.$DBNAME.'.Participation set shooterID = right(shooterID,13)');
            DB::update('update '.$DBNAME.'.shooterm set shooterID = right(shooterID,13)');
        });
        Model::reguard();
    }
}
