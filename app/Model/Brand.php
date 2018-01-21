<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model{

    protected $fillable = ['description'];

    public $rules = [
        'description' => 'required|min:3'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'brand_id');
    }
}
