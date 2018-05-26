<?php

use Illuminate\Database\Seeder;
use App\Model\Roles;

class RolesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Roles::create([
            'name'  => "ADM"
        ]);
        Roles::create([
            "name"  => "Gerente"
        ]);
        Roles::create([
            "name"  => "Operador"
        ]);
    }
}
