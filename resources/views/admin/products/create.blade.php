
@extends('layouts.app')

@section('content')

<h1>Criar Produto</h1>
<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
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
    <label>Comentario</label>
    <textarea col="2" row="5" name="body" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>
    @error('body')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Preço</label>
    <input type="text" name="price"  id="" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
     @error('price')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>

<div class="form-group">
    <label>Categorias</label>
     <select name="categories[]" class="form-control" multiple>
      @foreach($categories as $categoria)
        <option value="{{$categoria->id}}">{{$categoria->name}}</option>
      @endforeach
         
     </select>
</div>
<div class="form-group">
    <label>Imagens</label>
    <input type="file" name="photos[]"  id="" class="form-control @error('photos.*') is-invalid @enderror" multiple>
    @error('photos.*')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
</form>

@endsection
