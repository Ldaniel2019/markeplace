@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-md-6 m-0" style="padding:0px">

       @if($product->photos->count())
        <img class="card-img-top img-fluid" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="Card image cap">
       
           <div class="row">
               @foreach($product->photos as $photo)
               <div class="col-md-3 mt-1">
                  <img class="img-fluid" src="{{asset('storage/' . $photo->image)}}" alt="Card image cap">
               </div>
                @endforeach
           </div>
       
        @else 
        <img class="card-img-top" src="{{asset('asset/img/no-photo.jpg')}}" alt="Card image cap">
        @endif


    </div>

    <div class="col-md-6 mt-3">
      <div col="col-md-12>">
        <h3 class="card-title">{{$product->name}}</h3>
            <p class="card-text">{{$product->description}}</p>
            <h4 class="card-text">Preço: {{number_format($product->price,2,',','.')}}</h4>


            <p class="card-text"><span>Loja: <span> {{$product->store->name}}</p>

            
      </div>
       <div col="col-md-1 form-group"><!--Form comprar-->
          <hr>

            <form action="{{route('cart.add')}}" method="post">
              @csrf

              <input type="hidden" name="product[name]" value="{{$product->name}}">
              <input type="hidden" name="product[price]" value="{{$product->price}}">
              <input type="hidden" name="product[slug]" value="{{$product->slug}}">
               
              <label>Quantidade</label>
              <input type="number" name="product[amount]" value="1" min="1" max="50" class="col-md-5 form-control">
        
             <button type="submit" class="btn btn-comprar mt-2 pr-4"><span class="fa fa-cart-arrow-down fa-lg pr-3"></span>Adicionar ao carrinho</button>
            </form>
      </div>
    </div>
</div>   
<div class="row">
    <div class="col-md-12 mt-3">
    <hr>
    <p class="card-text">{{$product->body}}</p>
           
    </div>
</div>

@endsection