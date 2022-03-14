<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
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
        dd('OK'); 
        
        /*
        //Validação do form views/admin/pages/products/create.blade.php
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|min:3|max:10000',
            'photo' => 'required|image',
        ]);
        */

        // Pega todos os dados da requisição: 
        //dd($request->all());

        // Pega o campo name e description: 
        //dd($request->only(['name', 'description']));

        // Pega o campo name: 
        //dd($request->name);

        // Verifica se existe ou não 
        // dd($request->has('name'));

        // Se o campo não existe volta como default
        // dd($request->input('teste', 'default'));

        // Pega todos exceto 
        // dd($request->except('_token'));

        // Upload de arquivos: verifica se é válido
        if ($request->file('photo')->isValid()){
            // dd ($request->photo); // Todos as informações do arquivo
            // dd($request->photo->extension()); // Extensão do arquivo
            // dd($request->photo->getClientOriginalName()); // Nome original do arquivo
            

            // Arquivos ficam privados 
            // Salvando o arquivo dentro de storage / criando a pasta products
            // dd ($request->file('photo')->store('products'));

            // Salva com o nome informado no input + extensão do arquivo.
            $nameFile = $request->name . '.' . $request->photo->extension();
            dd($request->file('photo')->storeAs('products', $nameFile)); //Alterando o nome do arquivo.

            // Public - deixar os arquivos públicos
            // config / filesystems.php (alterar o default => 'local' para 'public')
            // Artisan criar link - >> php artisan storage:link
            // Ver link: >> ls -la public\
            // lrwxrwxrwx 1 Asus-Edilson 197609   56 mar  3 10:07 storage -> /c/docker/cursos/laravel-repositories/storage/app/public/ 
            // Ficou publico em: C:\docker\cursos\laravel-repositories\storage\app\products
        }
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
        
        if(!$product = Product::find($id))
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
