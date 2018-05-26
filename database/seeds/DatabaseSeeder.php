<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->call(UsersTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(SessionTableSeeder::class);
        $this->call(GondolaTableSeeder::class);
        $this->call(CategoryTableSeeder::class);        
        //$this->call(ProductTableSeeder::class);  
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionsRolesTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
    }
}
