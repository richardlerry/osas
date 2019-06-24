<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'John Patrick Loyola',
                'email' => 'loyolapat04@gmail.com',
                'password' => '$2y$10$Db7L7QsQJIFOB2uZ8c1UA.9cY17t.mJ6lBNBSLYaRqFeJTnXIDEYK',
                'role_id' => 1,
                'remember_token' => 'TSiYeaaLRkCMvnY6XOTSqG6YRBHMA0JqomiDpc0epr89RqVpP2xMA2qXcTTv',
                'stat' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2019-02-19 05:43:41',
            ),
        ));
        
        
    }
}