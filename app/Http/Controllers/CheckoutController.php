<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()

    {
        //session()->forget('pagseguro_session_code');
        if(!auth()->check()){
           return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        $cartItems = array_map(function($line){
           return $line['amount'] * $line['price'];

        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        //dd($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function  proccess(Request $request)
    {  
      
        $dataPost = $request->all();

        dd($dataPost);
       // $reference = 'XPTO'; 

      /*  $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
       
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference($reference);
        $creditCard->setCurrency("BRL");

        // Add an item for this payment request
        
        $cartItems = session()->get('cart');

        foreach($cartItems as $item){

            $creditCard->addItems()->withParameters(
                $reference,
                $item['name'],
                $item['amount'],
                $item['price']
                
            );

        }

        // Informações do comprador.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        
        $user = auth()->user();
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '27121238918'
        );

        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //Set billing information for credit card
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        
        $creditCard->setToken($dataPost['card_token']);  // Set credit card token
       
        list($quantity, $installmentamount) = explode('|', $dataPost['installment']);

        $installmentamount = number_format($installmentamount,2, '.' , '');
        $creditCard->setInstallment()->withParameters($quantity,$installmentamount);

        // Set the credit card holder information
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($dataPost['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '27121238918'
        );

        // Set the Payment Mode for this payment request
        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        //var_dump($result);

        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 42

        ];

        $user->orders()->create($userOrder);

        return response()->json([
            'data' =>[
                'status' =>true,
                'message' => 'Pedido criado com sucesso'
            ]
        ]);*/

    }

    private function makePagSeguroSession()
    {

        if(!session()->has('pagseguro_session_code')){

            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
       
    }
    

}