<?php

use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $this->command->info("Athlete Seeder Starting ");
        $previousResults = DB::table(env('MYSQL_SEEDER_DB', 'seedDB').'.nrai_i_ds_backup')->get();
        foreach($previousResults as $previousResult){
            $row = (array)$previousResult;
            //Following are commented because making them null will create understanding issues
            //as to why they are null.
            //if ($row['email'] == '-----') $row['email']  = NULL;
            //if ($row['contact'] == '-----') $row['contact']  = NULL;
            //Problmatic IDs
            if ($row['shooterID'] == 'SHM1205199101')continue; // cardNo 1375 and 3098 have this shooterID

            //DB::table('athletes')->insert( $row );
            App\Athlete::create($row);
        }
        $this->command->info("Athlete Seeder done ");
    }
}
