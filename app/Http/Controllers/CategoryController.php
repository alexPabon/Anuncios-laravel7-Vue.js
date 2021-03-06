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
        $this->middleware('auth')->except(['index']);
        $this->middleware('verified')->except(['index']);          
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    

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


        $category->save();            

        return $category;
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)    
    {              
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $validate= $request->validate([
            'name'=>'required|unique:categories|min:3|max:30'
        ]);
        
        
        $category->name= trim(Purify::clean($request->name));

        $category->update();     

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {        
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");
            
        $category->delete();       

        return ['success'=>'Eliminado correcto!'];
    }
}
