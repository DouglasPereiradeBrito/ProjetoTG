<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tag;
use App\Model\Product;

class TagController extends Controller{

    public function showCA($id = null){
        $title = "Tag";
        $route = "tag";
        $forms = ['id' => 'Id', 'product' => ['Produto', Product::all()]];

        if($id)
            $models = Tag::find($id);
        
        return view('tagSCA', compact('title', 'route', 'forms', 'models'));
    }

    public function showL(){
        $title = "Tag";
        $route = 'tag';
        $tables = [];

        $models = Tag::orderBy('id', 'asc')->paginate(5);

        return view('defaultList', compact('title', 'route', 'tables', 'models'));
    }
}