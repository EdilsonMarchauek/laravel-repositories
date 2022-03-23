<?php

use Illuminate\Support\Facades\Route;

//Controller - Criando os métodos do CRUD com Resource 
//php artisan make:controller ProductController --resource
//Aplicando um middleware na rota de Resource
//Criando a rota para filtrar
Route::any('products/search', 'ProductController@search')->name('products.search');
//Login
Route::resource('products', 'ProductController')->middleware('auth');

/*
//Controller - deletando um produto com Delete
Route::delete('products/{id}', 'ProductController@destroy')->name('products.destroy');

//Controller - edita um produto com Put
Route::put('products/{id}', 'ProductController@update')->name('products.update');

//Controller - exibe o form para edição de um produto
Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit');

//Controller - exibindo formulário
Route::get('products/create', 'ProductController@create')->name('products.create');

//Controller com parâmetros - exibe um produto específico
Route::get('products/{id}', 'ProductController@show')->name('products.show');

//Usando Controller - exibe todos
Route::get('products', 'ProductController@index')->name('products.index');

//Controller - Cadastro usar via Post
Route::post('products', 'ProductController@store')->name('products.store');
*/


Route::get('/login', function () {
    return 'Login';
})->name('login');

Route::middleware([])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/dashboard', 'TesteController@teste')->name('dashboard');
                Route::get('/financeiro', 'TesteController@teste')->name('financeiro');
                Route::get('/produtos', 'TesteController@teste')->name('products');
                Route::get('/', function () {
                    return redirect()->route('admin.dashboard');
                })->name('home');
            });
        });
    });
});

/*
Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'name' => 'admin.'
], function () {
    Route::get('/dashboard', 'TesteController@teste')->name('dashboard');

    Route::get('/financeiro', 'TesteController@teste')->name('financeiro');

    Route::get('/produtos', 'TesteController@teste')->name('products');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('home');
});
*/

// ACESSANDO UM ROTA NOMEADA
Route::get('redirect3', function () {
    return redirect()->route('url.name');
});

// route ('url.name');

// ROTAS NOMEADAS
Route::get('/name-url', function() {
    return 'Hey hey hey';
})->name('url.name');

// ROTA PASSANDO PARA VIEW
// Route::get('/', function () {
//    return view('welcome');
// });

// Rota para uma view - somente se for algo muito simples, estático, sempre passar pelo controller.
Route::view('/', 'welcome');

// REDIRECIONAMENTO - utilizando helper (funcoes) redirect
// Route::get('redirect1', function () {
//     return redirect('/redirect2');
// });

// REDIRECIONAMENTO DE ROTAS
Route::redirect('/redirect1', '/redirect2');

Route::get('redirect2', function () {
    return 'Redirect 02';
});

//ROTAS COM PARAMETROS OPCIONAIS - interrogação e define um valor para a variável
Route::get('/produtos/{idProduct?}', function ($idProduct = '') {
    return "Produtos(s) {$idProduct}";
});

//ROTA COM PARAMETROS - Variavel precisa ser igual ao nome da flag
Route::get('/categorias/{flag}/posts', function ($flag) {
    return "Posts da categoria: {$flag}";
});

//ROTA COM PARAMETROS - Variavel pode ter o nome diferente da flag
Route::get('/categorias/{flag}', function ($prm1) {
    return "Produtos da categoria: {$prm1}";
});

//MATCH - você define quais verbos 
Route::match(['get', 'post'], '/match', function () {
    return 'Match';
});

//ANY - funciona com todos o verbos http get, post
Route::any('/any', function () {
    return 'Any';
});

//POST Cadastrar
Route::post('/register', function () {
    return 'Sobre a Empresa';
});

Route::get('/empresa', function () {
    return 'Sobre a Empresa';
});

//Dentro de pasta usar o ponto
Route::get('/contato', function () {
    return view('site.contact');
});

//Retira da index o register
Auth::routes(['register' => false]);


