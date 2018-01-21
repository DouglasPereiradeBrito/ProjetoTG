<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $fillable = ['description'];

    public $rules = [
        'description'   => 'required|min:3' 
    ];
}
