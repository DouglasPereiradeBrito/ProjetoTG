<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Session;
use App\Model\Gondola;
use App\Model\HistoricProduct;
use App\Http\Controllers\Search;

class ProductController extends Controller{

    private $products;

    public function __construct(){
        $this->products = new Product();
    }

    public function showCA($id = null){
        $title = 'Produto';
        $route = 'produto';
        $forms = ['id' => 'ID', 'description' => 'Nome', 'price' => 'Preço', 'brand' => ['Marca', Brand::all()], 'category' => ['Categoria', Category::all()], 'session' => ['Sessão', Session::all()], 'gondola' => ['Gôndola', Gondola::all()]];

        if($id)
            $models = Product::with('brand', 'session', 'category', 'gondola')->find($id);
        
        return view('defaultSCA', compact(['models', 'title', 'route', 'forms']));
    }

    public function create(Request $request, Product $product){
        
        $this->validate($request, $this->products->rules, $this->products->messages);
        if($product->registerChange($request, isset($request->id) ? Product::find($request->id) : null))
            return redirect()->route('produto.list')->with('success', 'Produto Cadastrado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Cadastrar Produto.');
    }

    public function showL(){
        $title = 'Produto';
        $route = 'produto';
        $tables = ['ID', 'Nome', 'Marca', 'Sessão', 'Categoria', 'Gôndola', 'Preço', 'Criado', 'Atualizado', auth()->user()->can('SCA') ? 'Ação' : ''];
        $status = count(Product::where('status', true)->get());
        
        $models = Product::orderBy('id', 'asc')->with('brand', 'session', 'category', 'gondola')->paginate(5);
        
        return view('defaultList', compact(['models', 'title', 'route', 'tables', 'status']));
    }

    public function edit(Request $request, Product $product){
        $this->validate($request, $this->products->rules, $this->products->messages);
        if($product->registerChange($request, isset($request->id) ? Product::find($request->id) : null))
            return redirect()->route('produto.list')->with('success', 'Produto Alterado com Sucesso.');
        else    
            return redirect()->back()->with('error', 'Erro ao Alterar Produto.');
    }

    public function delete($id){
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
            
        $model = Search::quest($request->description, $request->criado, $request->atualizado, Product::class);
        
        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }

    public function liberar(){
        Product::where('status', false)->update(['status' => 'true']);

        return redirect()->route('produto.list');
    }

    public function fechar(){
        Product::where('status', true)->update(['status' => 'false']);

        return redirect()->route('produto.list');
    }
}
