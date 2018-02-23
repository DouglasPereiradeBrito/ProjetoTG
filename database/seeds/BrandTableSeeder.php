<?php

use Illuminate\Database\Seeder;
use App\Model\Brand;

class BrandTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Brand::create([
            'description'   => 'Bed Head'
        ]);

        Brand::create([
            'description'   => 'Aussie'
        ]);
        Brand::create([
            'description'   => 'Lòreal'
        ]);
        Brand::create([
            'description'   => 'LaRoche'
        ]);
        Brand::create([
            'description'   => 'Vichy'
        ]);
        Brand::create([
            'description'   => 'SkinCeuticals'
        ]);
    }
}
