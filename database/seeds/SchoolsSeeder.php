<?php

use Illuminate\Database\Seeder;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handler = fopen(__DIR__.'/../../data/schools.csv', 'r');
        DB::table('schools')->truncate();
        $defaultCity = \App\Model\City::find(1);
        while ( ($data = fgetcsv($handler)) !== false ) {
            DB::table('schools')->insert([
                'name' => $data[0],
                'city_id' => $defaultCity->id,
            ]);
        }
    }
}
