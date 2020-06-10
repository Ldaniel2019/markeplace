@extends('layouts.front')

@section('content')

<div class="row">
    @foreach($products as $key => $product)
    <div class="col-md-3 mt-3">
        <div class="card" style="width: 17rem;">
        @if($product->photos->count())
        <img class="card-img-top img-fluid" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="Card image cap">
        @else 
        <img class="card-img-top" src="{{asset('asset/img/no-photo.jpg')}}" alt="Card image cap">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <h6 class="card-text">Preço: {{number_format($product->price,2,',','.')}}</h6>
            <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success btn-sm">Ver Produto</a>
        </div>
        </div>
        </div>
        @if(($key + 1) % 4 == 0) </div><div class="row"> @endif
    @endforeach

</div>   


@endsection