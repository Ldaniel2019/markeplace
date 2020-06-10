
@extends('layouts.app')

@section('content')

<h1>Editar as informações da loja</h1>
<form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method('put')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">
     @error('name')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror


</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description"  id="" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">
     @error('description')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="phone"  id="" class="form-control  @error('phone') is-invalid @enderror" value="{{$store->phone}}">
    @error('phone')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror


</div>
<div class="form-group">
    <label>Telefone2</label>
    <input type="text" name="mobile_phone"  id="" class="form-control  @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
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
    <label>Slug</label>
    <input type="text" name="slug"  id="" class="form-control" value="{{$store->slug}}" readonly>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
</form>



<!--Exibição das fotos do produto--->

    <div class="row">      
        <div class="col-md-3 mt-3 mb-5" style="margin-buttom:20px">
                <div class="">
                  <img src="{{asset('storage/'.$store->logo)}}" alt="Logotipo" class="img-fluid img-thumbnail">
                </div>
        </div>
</div>
<!--/Exibição das fotos do produto--->
@endsection
