<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gondola extends Model{
    protected $fillable = ['description'];

    public $rules = [
        'description'   => 'required|min:3'
    ];
}
