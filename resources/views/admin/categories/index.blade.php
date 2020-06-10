
@extends('layouts.app')

@section('content')
<div class="float-right mt-2 mb-2">
    <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-primary">Criar uma categoria</a>
</div>
<table class="table table-striped table-bordered">
  <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Acções</th>
      </tr>
  </thead>

  <tbody> 
      @foreach($categories as $categoria)
      <tr>
        <th>{{$categoria->id}}</th>
         <th>{{$categoria->name}}</th>
         <th>{{$categoria->description}}</th>
        <th>
        <div class="btn-group">
         <a href="{{route('admin.categories.edit', ['category' => $categoria->id])}}" class="btn btn-sm btn-primary">Editar</a>
             
             <form action="{{route('admin.categories.destroy', ['category' => $categoria->id])}}" method="post">
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
    {{$categories->links()}}
</div>


@endsection