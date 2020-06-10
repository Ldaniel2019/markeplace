<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    private $product;
    
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store; //selecionamos a loja do usuario autenticado
        //$products = $this->product->paginate(10); seleciona todos os produtos.
        $products = $userStore->products()->paginate(10); //aqui selecionamos apenas os produtos da loja do usuario autenticado

        return view('admin.products.index', compact('products'));


    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        //$store = \App\Store::find($data['store']);
        $store = auth()->user()->store;

        $product = $store->products()->create($data);
        $product->category()->sync($data['categories']);

        if($request->hasFile('photos')){

            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);

        }

        flash('Produto criado com sucesso')->success();  //Imprime mensagem de sucesso

        return redirect()->route('admin.products.index');  //Redireciona o usuario a pagina de lista de produtos
    }

    /** Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        return $product; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        
        $products = $this->product->find($product);
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.edit', compact('products','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $product = $this->product->find($product);
        $product->update($data);
        $product->category()->sync($data['categories']);

        if($request->hasFile('photos')){

            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);

        }

        flash('Produto actualizado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int   $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();
     
        flash('Produto removido com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

}