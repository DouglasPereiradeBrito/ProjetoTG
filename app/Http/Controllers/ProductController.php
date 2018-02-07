<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Session;
use App\Model\Gondola;
use App\Model\HistoricProduct;

class ProductController extends Controller{

    public function showCA($id = null){
        $title = 'Produto';
        $route = 'produto';
        $forms = ['id' => 'ID', 'description' => 'Descrição', 'brand' => ['Marca', Brand::all()], 'category' => ['Categoria', Category::all()], 'session' => ['Sessão', Session::all()], 'gondola' => ['Gôndola', Gondola::all()], 'price' => 'Preço'];

        if($id)
            $models = Product::with('brand', 'session', 'category', 'gondola')->find($id);
        
        return view('defaultSCA', compact(['models', 'title', 'route', 'forms']));
    }

    public function create(Request $request, Product $product){
        if($product->registerChange($request, isset($request->id) ? Product::find($request->id) : null))
            return redirect()->route('produto.list')->with('success', 'Produto Cadastrado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Cadastrar Produto.');
    }

    public function showL(){
        $title = 'Produto';
        $route = 'produto';
        $tables = ['ID', 'Descrição', 'Marca', 'Sessão', 'Categoria', 'Gôndola', 'Preço', 'Criado', 'Atualizado', 'Ação'];

        $models = Product::orderBy('id', 'asc')->with('brand', 'session', 'category', 'gondola')->paginate(5);
 
        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }

    public function edit(Request $request, Product $product){
        if($product->registerChange($request, isset($request->id) ? Product::find($request->id) : null))
            return redirect()->route('produto.list')->with('success', 'Produto Alterado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Alterar Produto.');
    }

    public function delete($id){
        //dd((int) $id);
        if(Product::destroy($id))
            return redirect()->route('produto.list')->with('success', 'Produto Excluido com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Excluir Produto.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Produto';
        $route = 'produto';
        $tables = ['ID', 'Descrição', 'Marca', 'Sessão', 'Categoria', 'Gôndola', 'Preço', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Product::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = Product::where('description', 'like', "%$request->description%");
            
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = Product::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = Product::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }
}
