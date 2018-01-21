<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Session extends Model{

    protected $fillable = ['description'];

    public $rules = [
        'description'   => 'required|min:3'
    ];

    public $messages = [
        'description.required'  => 'O campo Descrição é de preenchimento obrigatorio.',
        'description.min'       => 'O campo Descrição deve conter no minimo 3 caracteres.'
    ];
}
