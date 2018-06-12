<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Http\Controllers\Search;
use App\Model\Product;

class BrandController extends Controller{

    protected $brand;

    public function __construct(){
        $this->brand = new Brand();
    }

    public function showCA($id = null){
        $title = 'Marca';
        $route = 'marca';
        $forms = ['id' => 'ID', 'description' => 'Nome'];

        if($id)
            $models = Brand::find($id);
            
        return view('defaultSCA', compact(['models', 'title', 'route', 'forms']));
    }

    public function showL(){
        $title = 'Marca';
        $route = 'marca';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        $models = Brand::paginate(5);

        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }

    public function edit(Request $request){
        $this->validate($request, $this->brand->rules, $this->brand->messages);

        $brand = Brand::find($request->id);

        if($brand->update($request->all()))
            return redirect()->route('marca.list')->with('success', "Marca Alterada com Sucesso.");
        else
            return redirect()->back()->with('error', "Erro ao Alterar Marca.");
    }

    public function create(Request $request){;
        $this->validate($request, $this->brand->rules, $this->brand->messages);

        if(Brand::create($request->all()))
            return redirect()->route('marca.list')->with('success','Marca Cadastrar com Sucesso.');
        else
            return redirect()->back()->with('error', 'Erro ao Cadastrar Marca.');
    }

    public function delete($id){
        $brand = Brand::find($id);
        
        if(count(Product::where('brand_id', $brand->id)->get()) == 0){
            if($brand->delete())
                return redirect()->route('marca.list')->with('success','Marca Excluida com Sucesso.');
            else
                return redirect()->back()->with('error', 'Erro ao Excluir Marca.');
        }else
            return redirect()->back()->with('excluir', 'Marca Está Vinculada a  um Produto.');
            
    }

    public function search(Request $request){
        $models = null;
        $title = 'Marca';
        $route = 'marca';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Brand::orderBy('id', 'asc')->paginate(5);
        
        $model = Search::quest($request->description, $request->criado, $request->atualizado, Brand::class);

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }
}