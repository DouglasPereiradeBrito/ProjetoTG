<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;

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
        
        if($brand->delete())
            return redirect()->route('marca.list')->with('success','Marca Excluida com Sucesso.');
        else
            return redirect()->back()->with('error', 'Erro ao Excluir Marca.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Marca';
        $route = 'marca';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Brand::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = Brand::where('description', 'like', "%$request->description%");//orderBy('id', 'asc')->paginate(5);
            
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = Brand::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = Brand::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }
}