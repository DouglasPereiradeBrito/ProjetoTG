<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategoryTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Category::create([
            'description'   => 'Cabelo'
        ]);
        Category::create([
            'description'   => 'Pele'
        ]);
        Category::create([
            'description'   => 'Shampoo'
        ]);
        Category::create([
            'description'   => 'Anti-idade'
        ]);
        Category::create([
            'description'   => 'Sabonete'
        ]);
        Category::create([
            'description'   => 'Infantil'
        ]);
    }
}
