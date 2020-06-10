
@extends('layouts.app')

@section('content')
<div class="float-right mt-2 mb-2">
    <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary">Criar novo Produto</a>
</div>
<table class="table table-striped table-bordered">
  <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Loja</th>
        <th>Acções</th>
      </tr>
  </thead>

  <tbody> 
      @foreach($products as $product)
      <tr>
        <th>{{$product->id}}</th>
         <th>{{$product->name}}</th>
          <th>{{number_format($product->price,2,',','.')}}</th>
          <th>{{$product->store->name}}</th>
        <th>
        <div class="btn-group">
         <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary">Editar</a>
             
             <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post">
                  @csrf
                  @method('delete')
                  <button class="btn btn-sm btn-danger ml-2">Remover</button>
             </form>
           </div>
        </th>
      </tr>
    @endforeach
  </tbody>


</table>

<div class="float-right mt-2 mb-2">
    {{$products->links()}}
</div>


@endsection