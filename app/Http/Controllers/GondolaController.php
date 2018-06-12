<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gondola;
use App\Http\Controllers\Search;
use App\Model\Product;

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

        if(count(Product::where('gondola_id', $this->gondola->id)->get()) == 0){
            if($this->gondola->delete())
                return redirect()->route('gondola.list')->with('success', "Gôndola Excluida com Sucesso.");
            else
                return redirect()->back('gondola.show', $id)->with('error', "Erro ao Excluir Gôndola.");
        }else
            return redirect()->back()->with('excluir', 'Gôndola Está Vinculada a um Produto.');
    }

    public function search(Request $request){
        $models = null;
        $title = 'Gôndola';
        $route = 'gondola';
        $tables = ['ID', 'Descrição', 'Criado', 'Atualizado', 'Ação'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = Gondola::orderBy('id', 'asc')->paginate(5);
        
        $model = Search::quest($request->description, $request->criado, $request->atualizado, Gondola::class);

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");

        return view('defaultList', compact(['models', 'title', 'tables', 'route']));
    }
}