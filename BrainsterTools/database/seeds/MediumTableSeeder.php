<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media')
        ->insert([
            [
                'medium' => 'Video',
            ],
            [
                'medium' => 'Book',
            ],

        ]);
    }
}
