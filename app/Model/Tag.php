<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model{
    public $fillable = ['product_id', 'tag_uid'];
}
