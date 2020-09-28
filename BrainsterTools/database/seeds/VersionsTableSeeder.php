<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VersionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('versions')
        ->insert([
            [
                'name' => 'Python 2',
            ],
            [
                'name' => 'Python 3',
            ],
            [
                'name' => 'Data Science',
            ],
            [
                'name' => 'Django',
            ],
   
        ]);
    }
}
