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

Route::get('/', 'Controller@iniMaster');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Rutas de contacto
Route::get('contact','MessageContactController@index')->name('contact.index')->middleware('throttle:60,1');
Route::get('contact/create','MessageContactController@create')->name('contact.create')->middleware('throttle:60,1');
Route::post('contact','MessageContactController@store')->name('contact.store')->middleware('throttle:7,1');

// Ruta de contacto Vue.js
Route::get('/contact-page','Controller@master');

// Ruta de COMENTARIOS
Route::apiResource('commentary','CommentaryController');

// Ruta de comentarios VUE.js
Route::get('/the-comments','Controller@master');

// Rutas de usuario
Route::apiResource('user', 'UserController')->middleware('throttle:10,1');
Route::get('user/delete/{delete}','UserController@delete')->name('user.delete')->middleware('throttle:10,1');

// Rutas Usuario vue.js
Route::get('/users','Controller@master');
Route::get('/myprofile','Controller@master');

// Rutas de adverts
Route::apiResource('advert','AdvertController');
Route::get('/myindex','AdvertController@myIndex');
Route::get('/advertcategory/{category}','AdvertController@index_filter')->name('indexFilter');

// Rutas de adverts vue.js
Route::get('/alladverts','Controller@master');
Route::get('/addadvert','Controller@master');
Route::get('/showadvert/{advert}','Controller@master');
Route::get('/myadverts','Controller@master');

// Rutas categories
Route::apiResource('category','CategoryController');

// Rutas categories VUE.js
Route::get('/categories','Controller@master');

// Ruta VISIT
Route::get('/visit','VisitController@updateIps');
Route::get('/visit-auth','VisitController@index_auth');
Route::get('/visit-no-auth','VisitController@index_no_auth');
Route::get('/visit/{ip}','VisitController@showNoAuth');
Route::get('/visitauth/{ip}','VisitController@showAuth');

// ruta visit VUE.js
Route::get('/visitors','Controller@master');
Route::get('/visitors-auth','Controller@master');
Route::get('/showip/{ip}/{auth}','Controller@master');

// Rutas PRIVILEGES
Route::apiResource('privilege','PrivilegeController');

// rutas privileges VUE.js
Route::get('/privileges','Controller@master');

// Ruta POFOLIO VUE.js
Route::get('/porfolio','Controller@master');

// Rutas de Imagenes
Route::apiResource('image','ImageController')->middleware('throttle:60,1');


Route::get('/migrate-all','Controller@migrateTable');

/**
 * @param $command = {migrate, links, maintenance, operative, update-ips, work}
 */
Route::get('/art-commands/{command}', 'Controller@artisanCommand')->middleware('auth');


//Route::get('/ip',function(){
//    dd($_SERVER['REMOTE_ADDR']);
//});

//Route::get('/visi',function (){
//    return \App\models\Consultasip::all();
//});

