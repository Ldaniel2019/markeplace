
@extends('layouts.app')

@section('content')

<h1>Editar Produtos</h1>
<form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">
@csrf
@method('put')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
     @error('name')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description"  id="" class="form-control" value="{{$category->description}}">
       
</div>


<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
</form>

@endsection
