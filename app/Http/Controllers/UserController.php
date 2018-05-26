<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\UsersRoles;
use App\Model\Roles;
use DB;

class UserController extends Controller{

    protected $users;

    public function __construct(){
        $this->users = new User();
    }

    public function showCA($id = null){
        $title = 'Usuário';
        $route = 'usuario';
        $forms = ['id' => 'ID', 'name' => 'Nome', 'fone' => 'Telefone', 'cpf' => 'CPF', 'email' => 'E-mail', 'password' => 'Senha'];
        $roles = ['Permissão', Roles::all()];
        
        
        if($id){
            $models = User::with('usersRoles')->where('id', $id)->get();
            $models = $models[0];
            
            //dd($models[0]->usersRoles[0]->role_id);
            //$models->password = '';
            
        }

        return view('defaultSCA', compact(['models', 'title', 'forms', 'route', 'roles']));
    }

    public function showL(){
        $title = 'Usuário';
        $route = 'usuario';
        $tables = ['ID', 'Nome', 'Telefone', 'CPF', 'E-mail', 'Criado', 'Atualizado'];

        $models = User::with('usersRoles.roles')->orderBy('id', 'desc')->paginate(5);
        //$permission = UsersRoles::with('roles')->where('user_id', $models->usersRoles->user_id)->all();
        //dd($models[0]->usersRoles[0]->roles->name);
        return view('defaultList', compact('title', 'models', 'route', 'tables'));
    }

    public function search(Request $request){
        $model = null;
        $models = null;
        $title = 'Usuário';
        $route = 'usuario';
        $tables = ['ID', 'Nome', 'Telefone', 'CPF', 'E-mail/Login', 'Criado', 'Atualizado'];

        if(is_Null($request->description) && is_Null($request->criado) && is_Null($request->atualizado))
            $models = User::orderBy('id', 'asc')->paginate(5);
        
        if(isset($request->description))
            $model = User::where('name', 'like', "%".ucfirst($request->description)."%")
                            ->orwhere('name', 'like', "%".strtolower($request->description)."%");
        
        if(isset($request->criado)){
            $created_at = explode(' - ', $request->criado);
            if(isset($model))
                $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            else
                $model = User::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
        }if(isset($request->atualizado)){
            $updated_at = explode(' - ', $request->atualizado);
            if(isset($model))
                $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
            else
                $model = User::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
        }

        $models = is_Null($models) ? $model->orderBy('id', 'asc')->paginate(5) : $models;
        
        if(count($models) <= 0)
            return redirect()->back()->with('error', "Usuário não existe.");
        
        return view('defaultList', compact('models', 'tables', 'title', 'route'));
    }

    public function create(Request $request){
        $this->validate($request, $this->users->rules, $this->users->messages);
        
        DB::beginTransaction();

        $role = UsersRoles::create([
            "role_id"   => (int) $request->role,
            "user_id"   => User::create([
                'name'      => $request->name,
                'fone'      => $request->fone,
                'cpf'       => $request->cpf,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ])->id
        ]);
        
        if($role){
            DB::commit();            
            return redirect()->route('usuario.list')->with('success', 'Usuário Cadastrado com Sucesso.');
        }else{
            DB::rollback();
            return redirect()->back('usuario.create', $request->id)->with('error', 'Erro ao Cadastrar Usuário.');
        }
    }

    public function edit(Request $request){
        
        $this->validate($request, $this->users->rules, $this->users->messages);

        DB::beginTransaction();

        $user = User::where('id', $request->id)->update([
            'name'      => $request->name,
            'fone'      => $request->fone,
            'cpf'       => $request->cpf,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        $role = UsersRoles::where('user_id', $request->id)->update([
            "role_id"   => (int) $request->role,
        ]);

        if($user && $role){
            DB::commit();         
            return redirect()->route('usuario.list')->with('success', 'Usuário Alterado com Sucesso.');
        }else{
            DB::rollback();
            return redirect()->back('usuario.register', $request->id)->with('error', 'Erro ao Alterado Usuário.');
        }
    }
}