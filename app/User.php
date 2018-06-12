<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;
use App\Model\HistoricProduct;
use App\Model\Permission;
use App\Model\Roles;
use App\Model\UsersRoles;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'fone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $guarded = [
        'password', 'remember_token'
    ];

    public $rules = [
        'name'      => 'required|min:3|string',
        'email'     => 'required|email',
        'cpf'       => 'required',
        'fone'      => 'required',
        'password'  => 'required'
    ];

    public $messages = [
        'name.required'         => 'O campo Nome é de preenchimento obrigatorio.',
        'name.min'              => 'O campo Nome deve conter no minino 3     caracteres.',
        'name.string'           => 'O campo Nome deve conter apenas caracteres.',
        'email.required'        => 'O campo E-mail é de preenchimento obrigatorio.',
        'email.email'           => 'O campo E-mail não está preenchido corretamente.',
        'cpf.required'          => 'O campo CPF é de preenchimento obrigatorio.',
        'fone.required'         => 'O campo Telefone é de preenchimento obrigatorio.',
        'password.required'     => 'O campo Senha é de preenchimento obrigatorio.'
    ];


    public function hasPermission(Permission $permission){
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles){
   
        if(is_array($roles) || is_object($roles)){
            $array = collect();
            //$user = UsersRoles::with('roles', 'user')->find(auth()->user()->id);
            $user = UsersRoles::with('roles', 'user')->where('user_id', auth()->user()->id)->get();
            $user = $user[0];
            foreach($roles as $role){
                $array[] = $role->name;
            }
            
            return !! $array->intersect($user->roles)->count();
        }
        
        return $array->contains('name', $roles);
    }

    public function usersRoles(){
        return $this->hasMany(UsersRoles::class);
    }
}