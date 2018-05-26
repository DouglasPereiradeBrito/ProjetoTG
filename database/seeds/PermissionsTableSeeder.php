<?php

use Illuminate\Database\Seeder;
use App\Model\Permission;

class PermissionsTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Permission::create([
            'name'  => 'SCA'
        ]);
        Permission::create([
            'name'  => 'L'
        ]);
    }
}
