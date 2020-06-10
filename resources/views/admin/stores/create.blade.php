
@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>
<form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
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
   <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">
     @error('description')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
     @error('phone')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Telefone2</label>
     <input type="text" name="mobile_phone" id="" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}">
     @error('mobile_phone')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Logotipo</label>
    <input type="file" name="logo"  id="" class="form-control @error('logo') is-invalid @enderror">
    @error('logo')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>


<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
</form>

@endsection
