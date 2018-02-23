<?php

use Illuminate\Database\Seeder;
use App\Model\Gondola;

class GondolaTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Gondola::create([
            'description'   => 'A'
        ]);
        Gondola::create([
            'description'   => 'B'
        ]);
        Gondola::create([
            'description'   => 'C'
        ]);
        Gondola::create([
            'description'   => 'D'
        ]);
        Gondola::create([
            'description'   => 'E'
        ]);
        Gondola::create([
            'description'   => 'F'
        ]);

        //corredor 
    }
}
