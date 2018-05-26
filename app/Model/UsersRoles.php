<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Roles;

class UsersRoles extends Model{

    public $fillable = ['user_id', 'role_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function roles(){
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
