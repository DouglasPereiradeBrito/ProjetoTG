<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Controllers\Search;
use App\Model\Product;

class CategoryController extends Controller{

    protected $categories;

    public function __construct(){
        $this->categories = new Category();
    }

    public function showCA($id = null){
        $title = 'Categoria';
        $route = 'categoria';
        $forms = ['id' => 'ID' , 'description' => 'Descrição',];

        if($id)
            $models = Category::find($id);
        
        return view('defaultSCA', compact(['models', 'route', 'forms', 'title']));
    }

    public function showL(){
        $title = 'Categoria';
        $tables = ['Id','Descrição','Criado','Atualizado','Ações'];
        $route = 'categoria';

        $models = Category::orderBy('id', 'asc')->paginate(5);

        return view('defaultList', compact(['models', 'route', 'tables', 'title']));
    }

    public function create(Request $request){
        $this->validate($request, $this->categories->rules);

        if(count(Category::where("description", $request->description)->get()) == 0){
            if(Category::create($request->all()))
                return redirect()->route('categoria.list')->with('success', "Categoria Cadastrada com Sucesso.");
            else
                return redirect()->back('categoria.register')->with('error', "Erro ao Cadastar Categoria.");
        }else{
            return redirect()->back()->with('error', 'Categoria Já Cadastrada.');
        }
    }

    public function edit(Request $request){
        $this->validate($request, $this->categories->rules);

        if(count(Category::where("description", $request->description)->get()) == 0){
            if(Category::where('id', $request->id)->update($request->all()))
                return redirect()->route('categoria.list')->with("success", 'Categoria Alterada com Sucesso.');
            else
                return redirect()->back('categoria.change')->with('error', 'Erro ao Alterar Categoria');
        }else{
            return redirect()->back()->with('error', 'Categoria Já Cadastrada.');
        }
    }

    public function delete($id){
        $this->categories = Category::find($id);

        if(count(Product::where('category_id', $this->categories->id)->get()) == 0){
            if($this->categories->delete())
                return redirect()->route('categoria.list')->with('success', 'Categoria Excluida com Sucesso.');
            else
                return redirect()->back('categoria.show', $id)->with('error', 'Erro ao Excluir Categoria.');
        }else
            return redirect()->back()->with('excluir', 'Categoria Está Vinculada a  um Produto.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Categoria';
        $tables = ['Id', 'Descrição', 'Criado', 'Atualizado', 'Ações'];
        $route = 'categoria';

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Category::orderBy('id', 'asc')->paginate(5);
        
        $model = Search::quest($request->description, $request->criado, $request->atualizado, Category::class);

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'route', 'tables', 'title']));
    }
}
