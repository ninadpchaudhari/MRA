<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info("Units Seeder Starting ");
        $results = DB::table(env('MYSQL_SEEDER_DB', 'seedDB').'.stateunit')->get(['stateUnit','abb','asnName']);

        foreach($results as $result){
            $row = (array)$result;
            // Renaming the column names to match the new naming convention
            $row['name'] = $row['stateUnit']; unset($row['stateUnit']);
            $row['abbreviation'] = $row['abb']; unset($row['abb']);
            $row['association_name'] = $row['asnName']; unset($row['asnName']);

            //DB::table('units')->insert($row);
            $oldUnit = \App\Unit::where('abbreviation',$row['abbreviation'])->first();
            if($oldUnit == null)
                App\Unit::create($row);

            else $oldUnit->update($row);
        }
        $this->command->info("Units Seeder done ");
    }
}
