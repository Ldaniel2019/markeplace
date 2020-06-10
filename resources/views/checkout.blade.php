@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-md-12 mb-3"> 
       <h3>Dados de pagamento</h3>
    </div>
<div class="col-md-6">
         <form action="#" method="post"><!--Form pagar-->
       
        <div class="form-group">
            <label for="card_name">Nome do Cartão</label>
            <input type="text" class="form-control" name="card_name" placeholder="">
        </div>

        <div class="form-group">
            <label for="card_number">Numero do Cartão <span class="brand"></span></label>
            <input type="text" class="form-control"  name="card_number" placeholder="">
            <input type="hidden" class="form-control"  name="card_brand">
        </div>
  </div>
</div>

<div class="row">    
        <div class="col-md-2 form-group">
            <label for="card_month">Mês de Expiração</label>
            <input type="number" class="form-control" name="card_month" min="1" max="12" placeholder="">   
        </div>

        <div class="col-md-2 form-group">
            <label for="card_year">Ano Expiração</label>
            <input type="number" class="form-control" name="card_year" min="2020" max="2040" placeholder="">
        </div>
         <div class="col-md-2 form-group">
            <label for="card_cvv">CVV</label>
            <input type="text" class="form-control" name="card_cvv" placeholder="">
        </div>
     </div>
     <div class="row">
        <div class="col-md-6 installments form-group"></div>  
   </div>

     <div class="row"> 
        <div class="col-md-3 float-right"> 
            <button type="submit" class="btn btn-comprar mt-2 pr-4 proccessCheckout"><span class="fa fa-cart-arrow-down fa-lg pr-3"></span>Efectuar o pagamento</button>
        </div>
  </div>

</form>

@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
     <script src="{{asset('asset/js/jquery.ajax.js')}}"></script>
    <script>
          const sessionId = '{{session()->get('pagseguro_session_code')}}';
    
          PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script>
          let amountTransaction = '{{$cartItems}}';
          let cardNumber = document.querySelector('input[name=card_number]');
          let spanBrand = document.querySelector('span.brand');

          cardNumber.addEventListener('keyup', function(){

               //console.log(cardNumber.value);
               if(cardNumber.value.length >= 6){
                    
                    PagSeguroDirectPayment.getBrand({
                     cardBin: cardNumber.value.substr(0, 6),
                     success : function(res){
                        //console.log(res);
                         let imgFlag = '<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/'+res.brand.name+'.png">'

                         spanBrand.innerHTML = imgFlag;

                         document.querySelector('input[name=card_brand]').value = res.brand.name;
                        
                         getInstallments(amountTransaction, res.brand.name);

                     },
                      error: function(err){
                         console.log(err);
                      },

                      complete: function(res){
                         //console.log('Complete: ' ,res);
                      }
                    });
               }
          });

         let submitButton = document.querySelector('button.proccessCheckout');

         submitButton.addEventListener('click', function(event){

               event.preventDefault();

             PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand:  document.querySelector('input[name=card_brand]').value,
                cvv:  document.querySelector('input[name=card_cvv]').value,
                expirationMonth:  document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: function(res){

                   // console.log(res);
                    proccessPayment(res.card.token);
                }

             });
         });


         function proccessPayment(token)
         {
             let data = {
                   card_token: token,
                   hash: PagSeguroDirectPayment.getSenderHash(),
                   installment : document.querySelector('select.select_installments').value,
                   card_name:  document.querySelector('input[name=card_name]').value,
                   _token: '{{csrf_token()}}'

             };

            $.ajax({

                type: 'POST',
                url: '{{route("checkout.proccess")}}',
                dataPost : data,
                dataType: 'json',
                success: function(res){
                   console.log(res);

                }

            });

         }

          function getInstallments(amount, brand){

                PagSeguroDirectPayment.getInstallments({
                    amount: amount,
                    brand: brand,
                    maxInstallmentNoInterest: 0,
                    success: function(res){
                       let selectInstallments = drawSelectInstallments(res.installments[brand]); 
                       document.querySelector('div.installments').innerHTML = selectInstallments;
                       //console.log(res);
                    },
                     error: function(err){

                    },
                     complete: function(res){

                    },

                })

          }

    function drawSelectInstallments(installments) {
		let select = '<label>Opções de Parcelamento:</label>';

		select += '<select class="form-control select_installments">';

		for(let l of installments) {
		    select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
		}


		select += '</select>';

		return select;
	}

    </script>
     
@endsection