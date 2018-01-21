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
            return redirect()->back()->with('error', 'Erroa ao Cadastrar Sessão.');
    }
}
