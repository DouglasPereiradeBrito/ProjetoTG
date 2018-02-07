<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\HistoricProduct;
use App\Model\Brand;

class Product extends Model{

    protected $fillable = ['description', 'price', 'session_id', 'category_id', 'gondola_id', 'brand_id'];

    public $rules = [
        'description'   => 'required|min:3',
        'price'         => 'required|numeric'
    ];

    public function gondola(){
        return $this->belongsTo(Gondola::class);
    }

    public function session(){
        return $this->belongsTo(Session::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function registerChange($value, $before){
        //dd($beforet);
        if(isset($value->id)){
            $obj = Product::find($value->id);
            $registerChange = $obj->update($value->all());
            $after = Product::find($value->id);
            //dd($before, $after);
        }else{
            $after = Product::create($value->all());
            $registerChange = $before = $after;
        }

        $historic = HistoricProduct::create([
            'user_id'                           => auth()->user()->id,
            'product_id'                        => $after->id,
            'product_before_description'        => $before->description,   
            'product_after_description'         => $after->description,
            'product_before_price'              => $before->price,
            'product_after_price'               => $after->price,
            'brand_before_description'          => $before->brand->description,
            'brand_after_description'           => $after->brand->description,
            'gondola_before_description'        => $before->gondola->description,
            'gondola_after_description'         => $after->gondola->description,
            'category_before_description'       => $before->category->description,
            'category_after_description'        => $after->category->description,
            'session_before_description'        => $before->session->description,
            'session_after_description'         => $after->session->description
        ]); 
        
        if($registerChange && $historic){
            return [
                'success' => true
            ];
        }else{
            return [
                'success' => false
            ];
        }
    }
}
