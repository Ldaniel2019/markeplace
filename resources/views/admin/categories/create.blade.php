
@extends('layouts.app')

@section('content')

<h1>Criar uma nova categoria</h1>
<form action="{{route('admin.categories.store')}}" method="post">
@csrf
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
     @error('name')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" id="" class="form-control" value=""> 
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
</form>

@endsection
