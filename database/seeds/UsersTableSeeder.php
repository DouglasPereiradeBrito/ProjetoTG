<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'name'      => 'Douglas Brito',
            'cpf'       => '010101010101',
            'fone'      => '17997253688',
            'email'     => 'douglas@gmail.com',
            'password'  => bcrypt('123456')
        ]);

        User::create([
            'name'      => 'Igor Febraro',
            'cpf'       => '01001010101',
            'fone'      => '9999999999',
            'email'     => 'igor@gmail.com',
            'password'  => bcrypt('123456')
        ]);
    }
}
