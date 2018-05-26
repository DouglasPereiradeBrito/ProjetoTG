<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UsersRoles;

class Roles extends Model{
    public function userRoles(){
        return $this->belongsTo(UsersRoles::class);
    }
}