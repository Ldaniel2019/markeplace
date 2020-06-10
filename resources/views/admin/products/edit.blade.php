
@extends('layouts.app')

@section('content')

<h1>Editar Produtos</h1>
<form action="{{route('admin.products.update', ['product' => $products->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method('put')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{$products->name}}">
     @error('name')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description"  id="" class="form-control @error('description') is-invalid @enderror" value="{{$products->description}}">
        @error('description')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Comentario</label>
    <textarea col="5" row="10" name="body" class="form-control @error('body') is-invalid @enderror">{{$products->body}}</textarea>
    @error('body')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror

</div>
<div class="form-group">
    <label>Preço</label>
    <input type="text" name="price"  id="" class="form-control @error('price') is-invalid @enderror" value="{{$products->price}}">
     @error('price')
         <div class="invalid-feedback">{{$message}}</div>
     @enderror
</div>
<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug"  id="" class="form-control" value="{{$products->slug}}" readonly>
</div>

<div class="form-group">
    <label>Categorias</label>
     <select name="categories[]" class="form-control" multiple>
      @foreach($categories as $categoria)
        <option value="{{$categoria->id}}"
        @if($products->category->contains($categoria)) selected @endif
        
        >{{$categoria->name}}</option>
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
    <a href="{{route('admin.products.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left pr-2"></i>Voltar</a>
    <button type="submit" class="btn btn-success"><i class="far fa-save pr-2"></i>Salvar</button>
</div>
</form>

<hr>
<!--Exibição das fotos do produto--->


    <div class="row">
          @foreach($products->photos as $foto)
              
        <div class="col-md-3 mt-3" style="margin-buttom:20px">
            <div class="card">
                <div class="">
                  <img src="{{asset('storage/'.$foto->image)}}" class="img-fluid">
                </div>
                <div class="card-body text-right">
                  <form action="{{route('admin.photo.remove')}}" method="post">
                          @csrf
                         <input type="hidden" name="photoName" class="form-control" value="{{$foto->image}}">
                       <button type="submit" class="btn btn-sm"><i class="far fa-trash-alt fa-lg" style="color:red"></i></button>
                   </form>
                </div>
            </div>
        </div>
       @endforeach
        

</div>
<!--/Exibição das fotos do produto--->
<h1></h1>
@endsection
