<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gondola extends Model{
    protected $fillable = ['description'];

    public $rules = [
        'description'   => 'required|min:1'
    ];

    public $messages = [
        'description.required'   => 'O campo Nome é de preenchimento obrigatório.',
        'description.min'        => 'O campo Nome deve conter no minimo 1 caracteres.'
    ];
}
