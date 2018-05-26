<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\WebService;

class WebServiceController extends Controller{

    public function create($ip){
        $models = Webservice::where('ip', $ip)->get();
        
        if(count($models) == 0){
            WebService::create(['ip' => $ip]);  
            return response()->json("IP Cadastrado");
        }
    }

}
