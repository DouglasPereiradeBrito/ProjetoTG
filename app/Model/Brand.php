<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model{

    protected $fillable = ['description'];

    public $rules = [
        'description'   => 'required|min:3'
    ];

    public $messages = [
        'description.required'   => 'O campo Nome é de preenchimento obrigatório.',
        'description.min'        => 'O campo Nome deve conter no minimo 3 caracteres.'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'brand_id');
    }
}
