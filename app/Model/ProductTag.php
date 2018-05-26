<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class ProductTag extends Model{
    protected $fillable = ['id', 'product_id', 'tag_uid'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
