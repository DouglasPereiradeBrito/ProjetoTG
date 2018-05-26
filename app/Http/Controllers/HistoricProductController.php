<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HistoricProduct;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Session;
use App\Model\Gondola;

class HistoricProductController extends Controller{

    public function showL(){
        $title = 'Histórico';
        $route = 'historico';
        $tables = ['' => 1, 'Usuário' => 1, 'Produto' => 4, 'Marca' => 2, 'Gôndola' => 2, 'Categoria' => 2, 'Sessão' => 2, '' => 1];
        $brands = Brand::all();
        $categories = Category::all();
        $sessions = Session::all();
        $gondolas = Gondola::all();

        $models = HistoricProduct::with('user')->orderBy('id', 'desc')->paginate(5);
        
        return view('defaultList', compact('models', 'tables', 'title', 'route', 'brands', 'gondolas', 'sessions', 'categories'));
    }

    public function search(Request $request){
        $models = null;
        $title = 'Histórico';
        $route = 'historico';
        $tables = ['' => 1, 'Usuário' => 1, 'Produto' => 4, 'Marca' => 2, 'Gôndola' => 2, 'Categoria' => 2, 'Sessão' => 2, '' => 1];
        $brands = Brand::all();
        $categories = Category::all();
        $sessions = Session::all();
        $gondolas = Gondola::all();

        if(is_Null($request->description) && is_Null($request->brand) && is_Null($request->session) && is_Null($request->category) && is_Null($request->gondola) && is_Null($request->criado))
            $models = HistoricProduct::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description)){
            $model = HistoricProduct::where('product_before_description', 'like', "%$request->description%")
                                    ->orWhere('product_after_description', 'like', "%$request->description%");

        }if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = HistoricProduct::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);

        }if(isset($request->brand)){
            if(isset($model))
                $model->where('brand_before_description', '=', $request->bran)
                        ->orWhere('brand_after_description', '=', $request->brand);
            else
                $model = HistoricProduct::where('brand_before_description', '=', $request->bran)
                                            ->orWhere('brand_after_description', '=', $request->brand);
      
        }if(isset($request->session)){
            if(isset($model))
                $model->where('session_before_description', $request->session)
                        ->orWhere('session_after_description', $request->session);
            else
                $model = HistoricProduct::where('session_before_description', $request->session)
                                            ->orWhere('session_after_description', $request->session);

        }if(isset($request->category)){
            if(isset($model))
                $model->where('category_before_description', $request->category)
                        ->orWhere('category_after_description', $request->category);
            else
                $model = HistoricProduct::where('category_before_description', $request->category)
                                            ->orWhere('category_after_description', $request->category);

        }if(isset($request->gondola)){
            if(isset($model))
                $model->where('gondola_before_description', $request->gondola)
                        ->orWhere('gondola_after_description', $request->gondola);
            else
                $model = HistoricProduct::where('gondola_before_description', $request->gondola)
                                            ->orWhere('gondola_after_description', $request->gondola);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;

        if(count($models) <= 0)
            return redirect()->back()->with('error', "Item não existe.");
        
        return view('defaultList', compact('models', 'tables', 'title', 'route', 'brands', 'gondolas', 'sessions', 'categories'));
    }
}
