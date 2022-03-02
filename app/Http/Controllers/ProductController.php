<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Injeção de dependência
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        //Middleware dentro do controller
        //$this->middleware('auth');

        //Middleware especificando um método para aplicar
        /*$this->middleware('auth')->only([
            'create', 'store'
        ]);*/

        //Middleware em todos menos em um específico
        //$this->middleware('auth')->except('index');

        /*Middleware em todos menos em index e show
        $this->middleware('auth')->except([
            'index', 'show'
        ]); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //Direcionando para index.blade.php 
        $teste = 123;
        $teste2 = 321;
        $teste3 = [1,2,3,4,5];
        $products = ['Tv', 'Geladeira', 'forno', 'Sofá'];
        //compact = cria array um array com as variáveis
        return view('admin.pages.products.index', compact('teste', 'teste2', 'teste3', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Método para a página de cadastro de produto
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Método que fará o cadastro do produto
    public function store(Request $request)
    {
        dd('Cadastrando...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Detalhes do produto {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Faz a edição do produto
    public function edit($id)
    {
        return view('admin.pages.products.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd("Editando o produto {$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
