@extends('layouts.front')

@section('content')
 <div class="row">
   @if($cart)
    <div class="col-md-12"><h3>Carinho de Compra</h3>
    </div>
    <div class="col-md-12">
        
            <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="pl-4">Produto</th>
                    <th class="text-right pr-4">Preço</th>
                    <th class="text-right pr-5">Quantidade</th>
                    <th class="text-right pr-4">Subtotal</th>
                    <th class="text-center">Acção</th>
                </tr>
            </thead>

            <tbody> 
                @php $total = 0;
                     $total_artigos = 0;
                @endphp
                @foreach($cart as $c)

                @php 
                   $Subtotal = $c['price'] * $c['amount'];
                   $total += $Subtotal;
                   $total_artigos += $c['amount'];
                @endphp
                <tr>
                    <th class="pl-4">{{$c['name']}}</th>
                    <th class="text-right pr-4">$ {{number_format($c['price'],2,',','.')}}</th>
                    <th class="text-right pr-5">{{$c['amount']}}</th>
                    <th class="text-right pr-4">$ {{number_format($Subtotal,2,',','.')}}</th>
                    <th class="text-center"><a href="{{route('cart.remove', ['slug' =>$c['slug']])}}" class="btn btn-sm btn-danger">Remover</a></th>
                </tr>
            @endforeach
                <tr>
                    <th colspan="2" class="text-center">Total</th>
                    <th class="text-right pr-5"> {{$total_artigos}}</th>
                    <th class="text-right pr-4">$ {{number_format($total,2,',','.')}}</th>
                    <th></th>
                </tr>
            
            </tbody>
        </table>
  </div>

  </div>  

        <div class="float-right">
            <a href="{{route('cart.cancel')}}" class="btn btn-sm btn-danger">Cancelar a compra</a>
            <a href="{{route('checkout.index')}}" class="btn btn-sm btn-comprar pr-4"><span class="fa fa-cart-arrow-down fa-lg pr-3"></span>Efectivar a compra</a>
           </div>
    @else
              <div class="col-md-12 bg-warning p-3"><h3>Seu carrinho de compras está vazio.</h3></div>
    @endif

@endsection



