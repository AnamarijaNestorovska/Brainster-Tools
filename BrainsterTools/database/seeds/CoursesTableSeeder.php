<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')
        ->insert([
            [
                'name' => 'Python for Everybody Specialization',
                'link' => 'https://www.coursera.org/specializations/python?ranMID=40328&ranEAID=jU79Zysihs4&ranSiteID=jU79Zysihs4-47bqHJjcvwYikVvEXlqvzg&siteID=jU79Zysihs4-47bqHJjcvwYikVvEXlqvzg&utm_content=10&utm_medium=partners&utm_source=linkshare&utm_campaign=jU79Zysihs4',
                'votes' => 10,
                'type_id' => 1,
                'level_id' => 1,
                'medium_id' => 1,
                'language_id' => 1,
                'user_id' => 1,
                'status' => 0

            ],
            [
                'name' => 'Learning Python with PyCharm',
                'link' => 'https://www.linkedin.com/learning/learning-python-with-pycharm?src=aff-lilpar&veh=aff_src.aff-lilpar_c.partners_pkw.1419154_plc.Hackr.io_pcrid.449670_learning&trk=aff_src.aff-lilpar_c.partners_pkw.1419154_plc.Hackr.io_pcrid.449670_learning&clickid=U3iXPe176xyOUWRwUx0Mo3EUUknS%3A2yIPVq5RM0&irgwc=1',
                'votes' => 0,
                'type_id' => 1,
                'level_id' => 2,
                'medium_id' => 1,
                'language_id' => 1,
                'user_id' => 2,
                'status' => 0

            ],
            [
                'name' => 'Java Programming Masterclass for Software Developers',
                'link' => 'https://www.udemy.com/course/java-the-complete-java-developer-course/?LSNPUBID=jU79Zysihs4&ranEAID=jU79Zysihs4&ranMID=39197&ranSiteID=jU79Zysihs4-aMZZPgLfnsY2ZRsuqISdWQ',
                'votes' => 0,
                'type_id' => 2,
                'level_id' => 1,
                'medium_id' => 2,
                'language_id' => 2,
                'user_id' => 3,
                'status' => 0
            ],
            [
                'name' => 'Seriously Good Software',
                'link' => 'https://www.manning.com/books/seriously-good-software?a_aid=hackrio',
                'votes' => 0,
                'type_id' => 1,
                'level_id' => 2,
                'medium_id' => 2,
                'language_id' => 1,
                'user_id' => 4,
                'status' => 0
            ],
            [
                'name' => 'Head First Java',
                'link' => 'https://www.amazon.it/dp/0596009208?tag=hackr069-21',
                'votes' => 3,
                'type_id' => 2,
                'level_id' => 2,
                'medium_id' => 2,
                'language_id' => 1,
                'user_id' => 1,
                'status' => 0
            ],
            
            

        ]);
    }
}
