<?php

namespace App\Http\Controllers;

use App\models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\models\Image;
use App\Http\Requests\adverts\AdvertStoreRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class AdvertController extends Controller
{    

    public function __construct(){
        $this->middleware('auth')->except(['index','index_filter','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advert::orderBy('id','DESC')->paginate(52);

        $adverts->each(function($advert){
            $advert->categories;
            $advert->image = $advert->images()->orderBy('id','DESC')->first();
        });

        return $adverts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_filter($idCategory)
    {
        $adverts = Advert::orderBy('updated_at','DESC')->get();

        $adverts->each(function($advert){
            $advert->categories;
            $advert->image = $advert->images()->orderBy('id','DESC')->first();
        });

        $advertFilter = [];
        $categoryName = '';

        foreach ($adverts as $advert) {
            foreach($advert->categories as $category){
                if($category->id==$idCategory){
                    $advertFilter[]=$advert;                                       
                }

                if($category->id==$idCategory)
                    $categoryName = $category->name;
            }
            if(count($advertFilter)>=50)
                break;
        }

        return ['total'=>count($advertFilter),'category'=>$categoryName,'adverts'=>$advertFilter];
    } 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myIndex()
    {
        $adverts = Advert::orderBy('id','DESC')->where('user_id','=',Auth::user()->id)->paginate(10);

        $adverts->each(function($advert){
            $advert->categories;
            $advert->image = $advert->images()->orderBy('id','DESC')->first();
        });

        return $adverts;
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\adverts\AdvertStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertStoreRequest $request)
    {       
        $user = Auth::user();                       
        
        try {

            DB::beginTransaction();               
            
            $cleanRequest = Purify::clean($request->post());
        
            $newProduct = new Advert();
            $newProduct->city= trim($cleanRequest['city']);
            $newProduct->product= trim($cleanRequest['product']);
            $newProduct->description= trim($cleanRequest['description']);
            $newProduct->quantity= intval($cleanRequest['quantity']);
            $newProduct->price= round(floatval($cleanRequest['price']),2);
            $newProduct->user_id= $user->id;

            $newProduct->save();       
            
            $newsImages = $request->images;           
            
            $newProduct->categories()->sync($cleanRequest['categories']);            

            if(!empty($newsImages)){                   
                
                foreach ($newsImages as $valueImage) {
                        
                    $ancho = intval(getimagesize($valueImage)[0]);
                    $alto = intval(getimagesize($valueImage)[1]);
                    $nameImage = Str::random(50).'.jpg';                    
                    
                    
                    if($ancho>=640||$alto>=640){
                        
                        $imgResize= Image::resize_img($valueImage);                                            
                        $path = Storage::disk('public')->put("images/tablon/$nameImage",$imgResize->stream());

                    }else{
                        
                        $imgResize = Image::encode_jpg($valueImage);
                        $path = Storage::disk('public')->put("images/tablon/$nameImage",$imgResize->stream());
                    }                   
                
                    $image = new Image();
                    $image->address= "/images/tablon/$nameImage";
                    $image->advert_id = $newProduct->id;
                    $image->save();
                }              
            }

            DB::commit();
            return ['success'=>'Se ha guardado Correctamente','id_produ'=>$newProduct->id];
            
        } catch (\Throwable $th) {
            DB::rollback();
            return ['errors'=>$th->getMessage()];
            
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        $advert->categories;
        $advert->images = $advert->images()->orderBy('id','DESC')->get();
        $advert->user;
        
        return $advert;
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\adverts\AdvertStoreRequest  $request
     * @param  \App\models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertStoreRequest $request, Advert $advert)
    {
        $user = Auth::user();       
        
        try {

            DB::beginTransaction();               
            
            $advert->city= trim(Purify::clean($request->city));
            $advert->product= trim(Purify::clean($request->product));
            $advert->description= trim(Purify::clean($request->description));
            $advert->quantity= intval(Purify::clean($request->quantity));
            $advert->price= round(floatval(Purify::clean($request->price)),2);

            $advert->update();
            
            $newsImages = $request->images;           
            
            $advert->categories()->sync($request->categories);            

            if(!empty($newsImages)){                   
                
                foreach ($newsImages as $valueImage) {
                        
                    $ancho = intval(getimagesize($valueImage)[0]);
                    $alto = intval(getimagesize($valueImage)[1]);
                    $nameImage = Str::random(50).'.jpg';                    
                    
                    
                    if($ancho>=640||$alto>=640){
                        
                        $imgResize= Image::resize_img($valueImage);                                            
                        $path = Storage::disk('public')->put("images/tablon/$nameImage",$imgResize->stream());

                    }else{
                        
                        $imgResize = Image::encode_jpg($valueImage);
                        $path = Storage::disk('public')->put("images/tablon/$nameImage",$imgResize->stream());
                    }                   
                
                    $image = new Image();
                    $image->address= "/images/tablon/$nameImage";
                    $image->advert_id = $advert->id;
                    $image->save();
                }              
            }

            DB::commit();
            return ['success'=>'Se ha actualizado Correctamente','id_produ'=>$advert->id];
            
        } catch (\Throwable $th) {
            DB::rollback();
            return ['errors'=>$th->getMessage()];
            
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $advert->images()->each(function($image){
            Storage::disk('public')->delete($image->address);
        });

        if(!$advert->delete())
            return back()->withErrors(['delete'=>'No se ha podido borrar, intentelo luego']);

        
        return ['success'=>'Eliminado correcto'];        
    }
}
