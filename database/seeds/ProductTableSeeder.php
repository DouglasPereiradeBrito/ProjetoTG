<?php

use Illuminate\Database\Seeder;
use App\Model\Product;

class ProductTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Product::create([
            'description'   => ''
        ]);
    }
}
