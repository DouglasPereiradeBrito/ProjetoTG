<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Session;
use App\Http\Controllers\Search;
use App\Model\Product;

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
        if(count(Product::where('session_id', $id)->get()) == 0){
            if(Session::destry($id))
                return redirect()->route('sessao.list')->with('success', 'Sessão Deletada com Sucesso.');
            else
                return redirect()->back()->with('error', 'Erro ao Deletar Sessão.');
        }else
            return redirect()->back()->with('excluir', 'Sessão Está Vinculada a um Produto.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Sessão';
        $route = 'sessao';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Session::orderBy('id', 'asc')->paginate(5);
        
        $model = Search::quest($request->description, $request->criado, $request->atualizado, Session::class);

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }
}
