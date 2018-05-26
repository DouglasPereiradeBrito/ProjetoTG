<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionRoles extends Model{
    
    public function roles(){
        return $this->belongsTo(Roles::class);
    }
    public function permissions(){
        return $this->belongsTo(Permissions::class);
    }
}
