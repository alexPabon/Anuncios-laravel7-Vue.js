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
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('./css/app.css')}}">
    </head>
    <body>
        <div id="app">
            <form class="my-2 border p-5" method="post" action="{{route('advert.store')}}" enctype="multipart/form-data">
                {{csrf_field()}} 
                <div class="form-group row">
                    <label for="inpcity" class="col-sm-2 col-form-label">city</label>
                    <input type="text" name="city" class="up form-control col-sm-10" id="inpcity" placeholder="city" maxlength="255"  value="{{old('city')}}">
                </div>        
                <div class="form-group row">
                    <label for="inproduct" class="col-sm-2 col-form-label">product</label>
                    <input type="text" name="product" class="up form-control col-sm-10" id="inproduct" placeholder="product" maxlength="255"  value="{{old('product')}}">
                </div>                
                <div class="form-group row">
                    <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
                    <input type="number" name="price" class="up form-control col-sm-4" id="inputPrecio" maxlength="11"  value="{{old('price')}}">
                </div>
                <div class="form-group row">
                    <label for="inquantity" class="col-sm-2 col-form-label">Cantidad</label>
                    <input type="number" name="quantity" class="up form-control col-sm-4" id="inquantity" maxlength="11"  value="{{old('quantity')}}">
                </div>                
                 <div class="form-group row">
                    <label for="inputColor" class="col-sm-2 col-form-label">Descripción</label>
                    <textarea class="form-control" rows="7" id="inputColor" name="description" placeholder="Maximo 500 caracteres" maxlength="500" >{{old('description')}}</textarea>
                </div>
                <div class="form-group row">
                    <figure class="row mt2 mb-2 col-10 offset-1">
                        <img height=250 class="fotos" id="user-img" src="">
                    </figure>
                    <p id="error_img"></p>
                </div>
                <div class="form-group row">
                    <label for="user-img-file" class="btn btn-primary active">Cargar Imagen</label>
                    <input type="file" name="images" class="up form-control-file col-sm-10" id="user-img-file">
                </div>
                <div class="">
                    <label for="categoria">categorias</label>
                    
                    <select class="selectpicker" name="categories[]" multiple>
                        <option value="1">Motor</option>
                        <option value="2" selected>formacion</option>
                        <option value="3">servicios</option>
                        <option value="11">Otrosss</option>
                      </select>
                      
                </div>
                <div class="form-group row">
                  <button type="submit" class="btn btn-success mx-2">Guardar</button>
                  <button type="reset" id="borrar" class="btn btn-secundary">Borrar</button>
                </div>
            </form> 
            <div>
                <img src="./storage/images/tablon/utpGqPuJChUJRIikaBFgfsUXCzmxNCXMzvUN1oJ0.png" alt="imagen">
            </div>          
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>              
    </body>
</html>

