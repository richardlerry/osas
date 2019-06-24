<?php

use Illuminate\Database\Seeder;

class RRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_roles')->delete();
        
        \DB::table('r_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'title' => 'osas',
                'desc' => 'Office of the Student Affairs and Services',
                'stat' => 1,
                'created_at' => '2019-06-23 15:05:46',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}