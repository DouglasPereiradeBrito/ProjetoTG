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
        if($product->registerChange($request))
            return redirect()->route('produto.list')->with('success', 'Produto Cadastrado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Cadastrar Produto.');
    }

    public function showL(){
        dd(HistoricProduct::all());
        $title = 'Produto';
        $route = 'produto';
        $tables = ['ID', 'Descrição', 'Marca', 'Sessão', 'Categoria', 'Gôndola', 'Preço', 'Criado', 'Atualizado', 'Ação'];

        $models = Product::orderBy('id', 'asc')->with('brand', 'session', 'category', 'gondola')->paginate(5);
 
        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }

    public function edit(Request $request, Product $product){
        if($product->registerChange($request))
            return redirect()->route('produto.list')->with('success', 'Produto Alterado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Alterar Produto.');
    }
}
