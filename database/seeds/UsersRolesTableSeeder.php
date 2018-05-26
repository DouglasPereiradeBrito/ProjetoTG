<?php

use Illuminate\Database\Seeder;
use App\Model\UsersRoles;

class UsersRolesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        UsersRoles::create([
            'user_id'   => 1,
            'role_id'  => 2
        ]);
        
        UsersRoles::create([
            'user_id'   => 2,
            'role_id'  => 3
        ]);
    }
}
