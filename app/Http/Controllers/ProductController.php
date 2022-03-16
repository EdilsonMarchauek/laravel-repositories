<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateProductRequest;

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

        if ($request->hasFile('image') && $request->image->isValid()){
            $imagePath = $request->image->store('products');

            $data['image'] =  $imagePath;
        }

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
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$product = $this->repository->find($id))
        return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()){

            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;

        }

        $product->update($data);

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

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }  

        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Search Products
     */

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    } 

}
