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
            $productTag = ProductTag::with('product')->where('tag_uid', $uid)->get();
            $webService = WebService::where('ip', 'like', $ip)->get();
            //dd($productTag[0], $webService[0]);
            $webServiceProduct = WebServiceProduct::where('product_id', $productTag[0]->product_id)->where('websevice_id', $webService[0]->id)->get();
            $produto = Product::with('brand', 'session', 'category', 'gondola')->find($productTag[0]->product->id);
            //dd($webServiceProduct);
        }

        if(count($webService) == 1){
            
            //dd($webServiceProduct);
            if(count($webServiceProduct) == 0){
                if(count(WebServiceProduct::where('websevice_id', $webService[0]->id)->get()) == 0){
                    //dd($webService[0]->id);
                    WebServiceProduct::create([
                        'product_id'   => $productTag[0]->product_id,
                        'websevice_id'  => $webService[0]->id
                    ]); 
                }
                if(count(Product::where('status', true)->get()) > 0){
                    WebServiceProduct::where('websevice_id', $webService[0]->id)->update([
                        'product_id'    => $productTag[0]->product_id
                    ]);   
                }
                $this->notification($produto);
                return $this->showLcdProduct($webService);              
            }else{
                if($productTag[0]->product_id == $webServiceProduct[0]->product_id){
                    return response()->json([$productTag[0]->product->description, $productTag[0]->product->price]);
                }else{
                    $this->notification($produto);
                    return $this->showLcdProduct($webService);
                }
            }
        }else{
            
            if($webService == null){
                $webService = WebService::where('ip', 'like', $ip)->get();
                if(count($webService) != 0){
                    return $this->showLcdProduct($webService);
                }else{
                    //return response()->json("Não há IP Cadastrado");
                    return $this->showLcdProduct($webService);
                }
            }else{
                //return response()->json("Não há IP Cadastrado");
                return $this->showLcdProduct($webService);
            }
        }
    }

    public function notification($produto){
        $description = "Produto ". $produto->description ." no local errado! Gondola ".$produto->gondola->description;
        $notification = Notification::where('description', 'like', $description)->whereDate('created_at',  date('Y/m/d'))->get();
        
        if(isset($notification) && !empty($notification[0])){
            if($notification[0]->description != $description){
                (new NotificationController())->create($description);
            }
        }else{
            (new NotificationController())->create($description);
        }
    }

    public function showLcdProduct($webService){
        if(count($webService)){
            $webService =  $webService[0];
            $webServiceProduct = WebServiceProduct::where('websevice_id', $webService->id)->get();

            if(count($webServiceProduct) > 0){
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