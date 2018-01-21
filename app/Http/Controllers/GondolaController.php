<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gondola;

class GondolaController extends Controller{

    protected $gondola;

    public function __construct(){
        $this->gondola = new Gondola();
    }

    public function showCA($id = null){
        $title = 'Gôndola';
        $forms = ['id' => 'ID', 'description' => 'Descrição'];
        $route = 'gondola';

        if($id)
            $models = Gondola::find($id);

        return view('defaultSCA', compact(['models', 'forms', 'route', 'title']));
    }

    public function create(Request $request){

        $this->validate($request, $this->gondola->rules);

        if(Gondola::create($request->all()))
            return redirect()->route('gondola.list')->with('success', 'Gôndola Cadastrada com Sucesso.');
        else
            return redirect()->back('gondola.create', $request->id)->with('error', 'Erro ao Cadastrar Gôndola.');
    }

    public function showL(){
        $title = 'Gôndola';
        $route = 'gondola';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        $models = Gondola::orderBy('id', 'asc')->paginate(5);

        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }

    public function edit(Request $request){
        $this->validate($request, $this->gondola->rules);

        $this->gondola = Gondola::find($request->id);

        if($this->gondola->update($request->all()))
            return redirect()->route('gondola.list')->with('success', 'Gôndola Alterada com Sucesso.');
        else
            return redirect()->back('gondola.show', $request->id)->with('error', 'Erro ao Alterar Gôndola.');
    }

    public function delete($id = null){
        $this->gondola = Gondola::find($id);
        if($this->gondola->delete())
            return redirect()->route('gondola.list')->with('success', "Gôndola Excluida com Sucesso.");
        else
            return redirect()->back('gondola.show', $id)->with('error', "Erro ao Excluir Gôndola.");
    }

    public function search(Request $request){
        $models = null;
        $title = 'Gôndola';
        $route = 'gondola';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Gondola::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = Gondola::where('description', 'like', "%$request->description%");//orderBy('id', 'asc')->paginate(5);
            
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = Gondola::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = Gondola::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }
}