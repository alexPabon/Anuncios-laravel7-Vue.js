<?php

namespace App\Http\Controllers;

use App\models\Privilege;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class PrivilegeController extends Controller
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

        $allPrivileges = Privilege::orderBy('id','DESC')->get();
        return $allPrivileges;
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
            'name'=>'required|unique:privileges|min:3|max:30',
            'label'=>'required|integer|max:3000',
        ]);

        $privilege = new Privilege();
        $privilege->name= trim(Purify::clean($request->name));
        $privilege->label= intval(Purify::clean($request->label));


        $privilege->save();            

        return $privilege;
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privilege $privilege)
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $validate= $request->validate([
            'name'=>'required|unique:privileges|min:3|max:30',
            'label'=>'required|integer|max:3000',
        ]);

        
        $privilege->name= trim(Purify::clean($request->name));
        $privilege->label= intval(Purify::clean($request->label));


        $privilege->update();        

        return $privilege;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        if(!isAdmin(Auth::user()->privilege_id))
        abort(403,"No estas autorizado");
        
        $privilege->delete();       

        return ['success'=>'Eliminado correcto!'];
    }
}
