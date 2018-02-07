<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class HistoricProduct extends Model{
    
    protected $fillable = [
        'user_id',
        'product_id',
        'product_before_description',
        'product_after_description',
        'product_before_price',
        'product_after_price',
        'brand_before_description',
        'brand_after_description',
        'gondola_before_description',
        'gondola_after_description',
        'category_before_description',
        'category_after_description',
        'session_before_description',
        'session_after_description'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}