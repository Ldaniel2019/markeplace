<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Estilo customizado -->
    <title>MARKEPLACE </title>
    
  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom:50px">
  <a class="navbar-brand" href="{{route('home')}}">Markeplace L6</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    @auth
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link @if(request()->is('')) active @endif" href="#">Disciplinas</a>
          </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->is('admin/stores*')) active @endif" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Lojas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="{{route('admin.stores.create')}}">Criar loja</a>
                      <a class="dropdown-item" href="{{route('admin.stores.index')}}">Ver</a>
                    </div>
                  </li>
                  <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                  </li>
                  <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                  </li>
        </ul>
        <div class="my-2 my-lg-0">
              <ul class="navbar-nav mr-auto">


              <li class="nav-item dropleft">
                    <a href="" class="nav-link text-white" 
                    data-toggle="dropdown"><i class="fas fa-user-cog fa-md pr-1"></i>{{auth()->user()->name}}</a>
                 <div class="dropleft">
                    <div class="dropdown-menu dropdown-menu-left">
                        <a href="#" class="dropdown-item pr-5"><span class="fa fa-home fa-lg pr-2"></span>Pagina Principal</a>
                        <a href="#" class="dropdown-item pr-5"><i class="fa fa-share-alt-square fa-lg pr-2"></i></span>Minha rede social</a>
                        <a href="" class="dropdown-item"></a>
        
                    </div>
                </div>

                </li>

              <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); 
                                                      document.querySelector('form.logout').submit();">Sair</a>
              
                <form action="{{route('logout')}}" class="logout" method="POST" style="display:none">
                  @csrf

                  </form>
              </li>
            </ul>
         </div>
      </div>
   @endauth
</nav>
        
         <div class="container" style="margin-buttom:20px">
              @include('flash::message')
                @yield('content')
         </div>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>