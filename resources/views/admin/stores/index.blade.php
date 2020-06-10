
@extends('layouts.app')

@section('content')

   @if(!$store)
    <a href="{{route('admin.stores.create')}}" class="btn btn-sm btn-primary">Criar nova loja</a>
     <div>
        <h1>Precisa criar uma loja para começar as suas operações</h1>
     </div>

@else
<table class="table table-striped table-bordered">
  <thead>
      <tr>
        <th>Id</th>
        <th>Loja</th>
        <th>Total Produtos</th>
        <th>Acções</th>
      </tr>
  </thead>

  <tbody> 
     
      <tr>
        <th>{{$store->id}}</th>
         <th>{{$store->name}}</th>
          <th>{{$store->products->count()}}</th>
        <th> 
        
        <div class="btn-group">
          <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary">Editar</a>
             
             <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="post">
                  @csrf
                  @method('delete')
                  <button class="btn btn-sm btn-danger ml-2">Remover</button>
             </form>
           </div>
        </th>
      </tr>
    
  </tbody>
</table>

@endif
@endsection