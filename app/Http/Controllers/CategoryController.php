<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

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
        //return response()->json($models);
    }

    public function create(Request $request){
        $this->validate($request, $this->categories->rules);

        if(Category::create($request->all()))
            return redirect()->route('categoria.list')->with('success', "Categoria Cadastrada com Sucesso.");
        else
            return redirect()->back('categoria.register')->with('error', "Erro ao Cadastar Categoria.");
    }

    public function edit(Request $request){
        $this->validate($request, $this->categories->rules);
        
        $this->categories = Category::find($request->id);

        if($this->categories->update($request->all()))
            return redirect()->route('categoria.list')->with("success", 'Categoria Alterada com Sucesso.');
        else
            return redirect()->back('categoria.change')->with('error', 'Erro ao Alterar Categoria');
    }

    public function delete($id){
        $this->categories = Category::find($id);

        if($this->categories->delete())
            return redirect()->route('categoria.list')->with('success', 'Categoria Excluida com Sucesso.');
        else
            return redirect()->back('categoria.show', $id)->with('error', 'Erro ao Excluir Categoria.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Categoria';
        $tables = ['Id', 'Descrição', 'Criado', 'Atualizado', 'Ações'];
        $route = 'categoria';

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Category::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = Category::where('description', 'like', "%$request->description%");//orderBy('id', 'asc')->paginate(5);
            
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = Category::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = Category::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'route', 'tables', 'title']));
    }
}
