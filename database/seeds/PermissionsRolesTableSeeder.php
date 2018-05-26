<?php

use Illuminate\Database\Seeder;
use App\Model\PermissionRoles;

class PermissionsRolesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        PermissionRoles::create([
            'roles_id'  => 1,
            'permission_id'  => 1
        ]);
        PermissionRoles::create([
            'roles_id'  => 1,
            'permission_id'  => 2
        ]);
        PermissionRoles::create([
            'roles_id'  => 3,
            'permission_id'  => 2
        ]);
        PermissionRoles::create([
            'roles_id'  => 2,
            'permission_id'  => 1
        ]);
        PermissionRoles::create([
            'roles_id'  => 2,
            'permission_id'  => 2
        ]);
    }
}
