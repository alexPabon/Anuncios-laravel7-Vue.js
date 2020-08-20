<?php

namespace App\Http\Controllers;

use App\models\Category;
use Error;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\ErrorHandler;
use PhpParser\Node\Stmt\Throw_;
use Stevebauman\Purify\Facades\Purify;


class CategoryController extends Controller
{   

    public function __construct()
    {        
        $this->middleware('auth');
        $this->middleware('verified');          
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado para ver este contenido");

        $allCategories = Category::orderBy('id','DESC')->get();
        return $allCategories;
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $validate= $request->validate([
            'name'=>'required|unique:categories|min:3|max:30'
        ]);

        $category = new Category();
        $category->name= trim(Purify::clean($request->name));


        if(!$category->save())
            return back()->withErrors(['store'=>'No se ha podido guardar, intentelo luego']);

        return $category;
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)    
    {              
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $validate= $request->validate([
            'name'=>'required|unique:categories|min:3|max:30'
        ]);
        
        
        $category->name= trim(Purify::clean($request->name));

        if(!$category->update())
            return back()->withErrors(['update'=>'No se ha podido actualizar, intentelo luego']);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {        
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");
            
        $category->delete();       

        return ['success'=>'Eliminado correcto!'];
    }
}
