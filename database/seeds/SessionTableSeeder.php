<?php

use Illuminate\Database\Seeder;
use App\Model\Session;

class SessionTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Session::create([
            'description'   => 'Suplementos'
        ]);
        Session::create([
            'description'   => 'Vitaminas'
        ]);
        Session::create([
            'description'   => 'Aparelhos de Saúde'
        ]);
        Session::create([
            'description'   => 'Conturções'
        ]);
        Session::create([
            'description'   => 'Colirios'
        ]);
        Session::create([
            'description'   => 'Repelentes'
        ]);
    }
}
