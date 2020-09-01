@php 
    $user='';
@endphp
@auth
    @php
        $user = Auth::user();    
        $user->privilege;
    @endphp    
@endauth   

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Anuncios segunda mano"> 
        <meta 
            name="keywords" 
            content="web, anuncios, segunda mano, motor, telefonia,
                    laravel, publicar, Alexander, Pabon, pabon,
                    imagen, sonido, juegos, alexander"
        >
        <meta name="author" content="Alexander Pabon"> 
        <meta name="user" content="{{ $user }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name')}} @yield('titulo')</title>

        

        <!-- Fonts -->
        <link rel="icon" href="/storage/images/favicon.png" type="image/png">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('./css/app.css')}}">        
   
    </head>
    <body>
        <div id="app" class="hg-8-container">
            <header>
                <menu-component titulo="{{ config('app.name', 'Laravel') }}" seemenu="true"></menu-component>
            </header>
            <div>                
                <router-view></router-view> 
            </div>            
        </div>       
        <x-my-footer.footer />
        <!-- Scripts -->        
        <script src="{{ asset('js/app.js') }}" defer></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>    
    </body>
</html>