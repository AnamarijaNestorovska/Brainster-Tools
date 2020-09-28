<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')
        ->insert([
            [
                'language' => 'English',
            ],
            [
                'language' => 'Spanish',
            ],
            [
                'language' => 'German',
            ],
            [
                'language' => 'Macedonian',
            ],

        ]);
    }
}
