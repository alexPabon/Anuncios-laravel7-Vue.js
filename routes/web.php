<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\models\Advert;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Rutas de contacto
Route::get('contact','MessageContactController@index')->name('contact.index')->middleware('throttle:60,1');
Route::get('contact/create','MessageContactController@create')->name('contact.create')->middleware('throttle:60,1');
Route::post('contact','MessageContactController@store')->name('contact.store')->middleware('throttle:7,1');

// Ruta de contacto Vue.js
Route::get('/contact-page',function(){return view('layouts.master');});

// Ruta de COMENTARIOS
Route::apiResource('commentary','CommentaryController');

// Ruta de comentarios VUE.js
Route::get('/allcomments',function(){return view('layouts.master');});

// Rutas de usuario
Route::apiResource('user', 'UserController')->middleware('throttle:10,1');
Route::get('user/delete/{delete}','UserController@delete')->name('user.delete')->middleware('throttle:10,1');

// Rutas Usuario vue.js
Route::get('/users',function(){return view('layouts.master');});
Route::get('/myprofile',function(){return view('layouts.master');});

// Rutas de adverts
Route::apiResource('advert','AdvertController');
Route::get('/myindex','AdvertController@myIndex');
Route::get('/indexcategory/{category}','AdvertController@index_filter');

// Rutas de adverts vue.js
Route::get('/alladverts',function(){return view('layouts.master');});
Route::get('/addadvert',function(){return view('layouts.master');});
Route::get('/showadvert/{advert}',function(){return view('layouts.master');});
Route::get('/myadverts',function(){return view('layouts.master');});

// Rutas categories
Route::apiResource('category','CategoryController');

// Rutas categories VUE.js
Route::get('/categories',function(){return view('layouts.master');});

// Ruta VISIT
Route::get('/visit','VisitController@updateIps');
Route::get('/allvisit','VisitController@index_all');
Route::get('/visit/{ip}','VisitController@showNoAuth');
Route::get('/visitauth/{ip}','VisitController@showAuth');

// ruta visit VUE.js
Route::get('/visitors',function(){return view('layouts.master');});
Route::get('/showip/{ip}/{auth}',function(){return view('layouts.master');});

// Rutas PRIVILEGES
Route::apiResource('privilege','PrivilegeController');

// rutas privileges VUE.js
Route::get('/privileges',function(){return view('layouts.master');});

// Rutas de Imagenes
Route::apiResource('image','ImageController')->middleware('throttle:60,1');

Route::get('/prueba', function(){
    $us = User::find(1);
    $us->adverts;
    $us->adverts->each(function($advert){
        $advert->categories;
        $advert->images = $advert->images()->orderBy('id','DESC')->get();
    });
    return $us;
});

Route::get('/pruebaAll',function(){
    $users = User::all();
    $users->each(function($user){
        $user->adverts->each(function($advert){
            $advert->categories;
            $advert->images=
            $advert->images()->orderBy('id','DESC')->first();
        });
    });

    return $users;
});

Route::get('/advcat',function(){
    $adv = Advert::find(7);

    try {
        $adv->categories()->attach(6);
        $adv->categories;
        return $adv;
    } catch (Throwable $e) {        
        
        // return $e->getCode();
        return back();
    }            
});

Route::get('/formadd',function(){
    return view('anunci.addform');
});

Route::get('/adm',function(){
    Artisan::call('storage:link');
});

