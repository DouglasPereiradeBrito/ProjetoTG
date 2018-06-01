<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {
    Route::prefix('marca')->group(function () {
        Route::get('cadastrar', 'BrandController@showCA')->name('marca.register');
        Route::get('listar', 'BrandController@showL')->name('marca.list');
        Route::post('create', 'BrandController@create')->name('marca.create');
        Route::post('edit', 'BrandController@edit')->name('marca.edit');
        Route::get('alterar/{id}', 'BrandController@showCA', function($id){
            return $id;
        })->name('marca.change');
        Route::get('visualizar/{id}', 'BrandController@showCA', function($id){
            return $id;
        })->name('marca.show');
        
        Route::get('delete/{id}', 'BrandController@delete', function($id){
            return $id;
        })->name('marca.delete');

        Route::get('pesquisa/{nome?}', 'BrandController@search', function($nome){
            return $nome;
        })->name('marca.search');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('categoria')->group(function(){
        Route::get('cadastrar', 'CategoryController@showCA')->name('categoria.register');
        Route::post('create', 'CategoryController@create')->name('categoria.create');
        Route::get('listar', 'CategoryController@showL')->name('categoria.list');
        Route::get('visualizar/{id}', 'CategoryController@showCA', function($id){
            return $id;
        })->name('categoria.show');
        Route::post('alterar/{id?}', 'CategoryController@edit', function($id){
            return $id;
        })->name('categoria.edit');
        Route::get('pesquisa/{nome?}', 'CategoryController@search', function($nome){
            return $nome;
        })->name('categoria.search');
        Route::get('delete/{id}', 'CategoryController@delete', function($id){
            return $id;
        })->name('categoria.delete');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('gondola')->group(function(){
        Route::get('cadastrar', 'GondolaController@showCA')->name('gondola.register');
        Route::post('create', 'GondolaController@create')->name('gondola.create');
        Route::post('alterar/{id?}', 'GondolaController@edit', function($id){
            return $id;
        })->name('gondola.edit');
        Route::get('delete/{id}', 'GondolaController@delete', function($id){
            return $id;
        })->name('gondola.delete');
        Route::get('listar', 'GondolaController@showL')->name('gondola.list');
        Route::get('pesquisar', 'GondolaController@search')->name('gondola.search');
        Route::get('visualizar/{id}', 'GondolaController@showCA', function($id){
            return $id;
        })->name('gondola.show');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('sessao')->group(function(){
        Route::get('cadastrar', 'SessionController@showCA')->name('sessao.register');
        Route::post('create', 'SessionController@create')->name('sessao.create');
        Route::post('alterar/{id?}', 'SessionController@edit', function($id){
            return $id;
        })->name('sessao.edit');
        Route::get('delete/{id}', 'SessionController@delete', function($id){
            return $id;
        })->name('sessao.delete');
        Route::get('listar', 'SessionController@showL')->name('sessao.list');
        Route::get('pesquisar', 'SessionController@search')->name('sessao.search');
        Route::get('visualizar/{id}','SessionController@showCA', function($id){
            return $id;
        })->name('sessao.show');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('produto')->group(function(){
        Route::get('cadastrar', 'ProductController@showCA')->name('produto.register');
        Route::post('create', 'ProductController@create')->name('produto.create');
        Route::post('edit/{id?}', 'ProductController@edit', function($id){
            return $id;
        })->name('produto.edit'); 
        Route::get('delete/{id}', 'ProductController@delete', function($id){
            return $id;
        })->name('produto.delete');
        Route::get('listar', 'ProductController@showL')->name('produto.list');
        Route::get('pesquisar', 'ProductController@search')->name('produto.search');
        Route::get('visualizar/{id}', 'ProductController@showCA', function($id){
            return $id;
        })->name('produto.show');
        Route::get('liberar', 'ProductController@liberar')->name('produto.liberar');
        Route::get('fechar', 'ProductController@fechar')->name('produto.fechar');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('historico')->group(function(){
        Route::get('listar', 'HistoricProductController@showL')->name('historico.list');
        Route::get('pesquisar', 'HistoricProductController@search')->name('historico.search');
        Route::get('visualizar/{id}', 'HistoricProductController@showCA', function($id){
            return $id;
        })->name('historico.show');
    });
});

//Route::middleware(['auth'])->group(function(){
    Route::prefix('tag')->group(function(){
        Route::get('cadastrar', 'TagController@showCA')->name('tag.register');
        Route::get('create/{uid?}&{id}', 'TagController@create', function($uid, $id){
            return $uid;
        })->name('tag.create');
        Route::get('edit/{uid?}&{id}', 'TagController@edit', function($uid, $id){
            return $uid;
        })->name('tag.edit');
        //Route::get('delete', 'TagController@delete')->name('tag.delete');
        Route::get('listar/{uid?}','TagController@jsonTag', function($uid){
            return $uid;
        })->name('tag.list');
        Route::get('verify/{uid?}','TagController@verifyTag', function($uid){
            return $uid;
        })->name('tag.verify');
        Route::get('showTag/{uid?}&{ip}','TagController@showTag', function($uid){
            return $uid;
        })->name('tag.showTag');
    });
//});

Route::prefix('webServiceProduct')->group(function(){
    Route::get('create/{id}&{ip}', 'WebServiceProductController@create')->name('webserviceproduct.create');
});

//verificar com o rogerio middleware
Route::prefix('webService')->group(function(){
    Route::get('create/{ip}', 'WebServiceController@create')->name('webservice.create');
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('usuario')->group(function(){
        Route::get('cadastrar', 'UserController@showCA')->name('usuario.register');
        Route::post('create', 'UserController@create')->name('usuario.create');
        Route::post('edit/{id?}', 'UserController@edit', function($id){
            return $id;
        })->name('usuario.edit'); 
        Route::get('delete/{id}', 'UserController@delete', function($id){
            return $id;
        })->name('usuario.delete');
        Route::get('listar', 'UserController@showL')->name('usuario.list');
        Route::get('pesquisar', 'UserController@search')->name('usuario.search');
        Route::get('visualizar/{id}', 'UserController@showCA', function($id){
            return $id;
        })->name('usuario.show');
    });
});
Route::prefix('notification')->group(function(){
    Route::get('list', "NotificationController@showList")->name('notification.list');
    Route::get('create', "NotificationController@create")->name('notification.create');
    Route::get('visualizar', "NotificationController@show")->name('notification.show');
    Route::get('delete/{id}', "NotificationController@delete", function($id){
        return $id;
    })->name('notification.delete');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');
