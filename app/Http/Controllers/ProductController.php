<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Injeção de dependência
    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;

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
        //$products = Product::all();
        //$products = Product::get();
        $products = Product::paginate(); //Padrão 15 por página, podendo ser altera paginate(50)
        $products = Product::latest()->paginate(); //Pega os últimos registros

        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
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
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */

     //Método que fará o cadastro do produto
    public function store(StoreUpdateProductRequest $request)
    {   
        $data = $request->only('name', 'description', 'price');

        $this->repository->create($data);

        return redirect()->route('products.index');
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Recuperando um produto pelo id
        //$product = Product::where('id', $id)->first();
        
        if(!$product = $this->repository->find($id))
          return redirect()->back();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
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
        if(!$product = $this->repository->find($id))
        return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
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
        if(!$product = $this->repository->find($id))
        return redirect()->back();

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->where('id', $id)->first();
        if(!$product)
          return redirect()->back();

        $product->delete();

        return redirect()->route('products.index');
    }
}
