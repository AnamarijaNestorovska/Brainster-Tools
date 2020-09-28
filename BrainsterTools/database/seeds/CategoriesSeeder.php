<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')
        ->insert([
            [
                'name' => 'Programming',
                'slug' => 'programming',
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
            ]
        ]);
    }
}
