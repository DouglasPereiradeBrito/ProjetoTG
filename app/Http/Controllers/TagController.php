<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tag;
use App\Model\Product;
use App\Model\ProductTag;
use App\Model\WebServiceProduct;
use App\Model\WebService;
use App\Http\Controllers\NotificationControllers;
use App\Model\Notification;

class TagController extends Controller{
    protected $tags;

    public function __construct(){
        $this->tags = new ProductTag();
    }

    public function showCA($id = null){
        $title = "Tag";
        $route = "tag";
        $forms = ['product' => ['Produto', Product::all()]];

        if($id)
            $models = Tag::find($id);
        
        return view('tagSCA', compact('title', 'route', 'forms', 'models'));
    }
    //mostra na tabela
    public function jsonTag(Request $request, $id){
        header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json; charset=utf-8');
        $models = ProductTag::with('product')->where('product_id', $id)->paginate(5);
        
        return response()->json($models);
    }
    
    public function showTag($uid, $ip){
        $webService = null;
        if($uid != 0){
            $models = ProductTag::with('product')->where('tag_uid', $uid)->get();
            $webServiceProduct = WebServiceProduct::where('product_id', $models[0]->product->id)->get();
            $webService = WebService::where('ip', 'like', $ip)->get();
            $produto = Product::with('brand', 'session', 'category', 'gondola')->find($models[0]->product->id);
        }
        //dd($webServiceProduct);
        /*$url = "http://192.168.103.161/ip"; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result = curl_exec($ch);
        curl_close($ch);
        dd($result);*/
        ///terminar
        /*foreach($webServiceProduct as $webService){
            echo $webService->ip;
        }*/
        //dd(count(WebService::where('ip', 'like', $ip)->get()));
        if(count($webService) == 1){
            if(count($webServiceProduct) == 0){
                /*WebServiceProduct::create([
                    'websevice_id'  => $webService[0]->id
                    'product_id'    => $models[0]->product->id
                ]);*/
                //dd($produto->description);
                $description = "Produto ". $produto->description ." no local errado! Gondola ".$produto->gondola->description;
                $teste = Notification::where('description', 'like', $description)->whereDate('created_at',  date('Y/m/d'))->get();
                
                if(isset($teste) && !empty($teste[0])){
                    if($teste[0]->description != $description){
                        (new NotificationController())->create($description);
                    }
                }else{
                    (new NotificationController())->create($description);
                }
                //TODO ainda mostrar produto
                //$notification->create($description);
                //return response()->json($description);
                
            }else{
                
                if($models[0]->product->id == $webServiceProduct[0]->product_id && $webServiceProduct[0]->websevice_id == $webService[0]->id){
                    return response()->json([$models[0]->product->description, $models[0]->product->price]);
                }else {
                    //return response()->json("Produto em local Indevido");
                    $webServiceProduct = WebServiceProduct::where('websevice_id', $webService[0]->id)->get();
                    $models = Product::where('id', $webServiceProduct[0]->product_id)->get();
                    return response()->json([$models[0]->description, $models[0]->price]);
                }
            }
        }else{
            if($webService == null){
                $webService = WebService::where('ip', 'like', $ip)->get();
                if(count($webService) != 0){
                    $webServiceProduct = WebServiceProduct::where('websevice_id', $webService[0]->id)->get();
                    $models = Product::where('id', $webServiceProduct[0]->product_id)->get();
                    return response()->json([$models[0]->description, $models[0]->price]);
                }else{
                    //return response()->json("Não há IP Cadastrado");
                    $webServiceProduct = WebServiceProduct::where('websevice_id', $webService[0]->id)->get();
                    $models = Product::where('id', $webServiceProduct[0]->product_id)->get();
                    return response()->json([$models[0]->description, $models[0]->price]);
                }
            }else{
                //return response()->json("Não há IP Cadastrado");
                $webServiceProduct = WebServiceProduct::where('websevice_id', $webService[0]->id)->get();
                $models = Product::where('id', $webServiceProduct[0]->product_id)->get();
                return response()->json([$models[0]->description, $models[0]->price]);
            }
        }
    }

    public function create($uid, $product_id){
        $uids = explode(',', $uid);

        for($x = 0; $x < count($uids); $x++){
            ProductTag::create([
                'product_id'    => $product_id,
                'tag_uid'       => $uids[$x]
            ]);
        }
    }

    public function edit($uid, $product_id){        
        if(ProductTag::where('tag_uid', $uid)->update(['product_id' =>  $product_id]))
            return redirect()->route('tag.register')->with("success", 'Tag Alterada com Sucesso.');
        else
            return redirect()->route('tag.register')->with('error', 'Erro ao Alterar Tag');
    }

    public function verifyTag($uid){
        $models = ProductTag::with('product')->where('tag_uid', $uid)->get();
        $product = Product::all();
        if($models)
            return response()->json(['productTag' => $models, 'product' => $product]);
    }
}