<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Session;

class SessionController extends Controller{
    
    protected $sessions;

    public function __construct(){
        $this->sessions = new Session();
    }

    public function showCA($id = null){
        $title = 'Sessão';
        $forms = ['id' => 'ID', 'description' => 'Descrição'];
        $route = 'sessao';

        if($id)
            $models = Session::find($id);
        
        return view('defaultSCA', compact(['models', 'title', 'forms', 'route']));
    }

    public function showL(){
        $title = 'Sessão';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];
        $route = 'sessao';

        $models = Session::orderBy('id', 'asc')->paginate(5);

        return view('defaultList', compact(['models', 'title', 'route', 'tables']));
    }

    public function create(Request $request){
        $this->validate($request, $this->sessions->rules, $this->sessions->messages);

        if(Session::create($request->all()))
            return redirect()->route('sessao.list')->with('success', 'Sessão Cadastrada com Sucesso.');
        else
            return redirect()->back()->with('error', 'Erro ao Cadastrar Sessão.');
    }

    public function edit(Request $request){
        $this->validate($request, $this->sessions->rules);

        $this->sessions = Session::find($request->id);

        if($this->sessions->update($request->all()))
            return redirect()->route('sessao.list')->with('success', 'Sessão Alterada com Sucesso.');
        else
            return redirect()->back()->with('error', 'Erro ao Alterar Sessão.'); 
    }

    public function delete($id = null){
        if(Session::destry($id))
            return redirect()->route('sessao.list')->with('success', 'Sessão Deletada com Sucesso.');
        else
            return redirect()->back()->with('error', 'Erro ao Deletar Sessão.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Sessão';
        $route = 'sessao';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Session::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = Session::where('description', 'like', "%$request->description%");//orderBy('id', 'asc')->paginate(5);
            
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = Session::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = Session::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }
}
