<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\WebServiceProduct;

class WebServiceProductController extends Controller{

    public function create($id, $ip){
        WebServiceProduct::create([
            'ip'    => $ip
        ]);  
    }

}
