<?php

namespace App\Http\Controllers;

use App\models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\models\Consultasip;

use App\Traits\PointOnMapTrait;
use App\Traits\SavePlaceTrait;

class VisitController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');        
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_all()
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $allvisit = SavePlaceTrait::searchAllips();

        return $allvisit;
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateIps()
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $ipAuth = Visit::select(['number_ip'])->groupBy('number_ip')->get();
        $ipNoAuth = Consultasip::select(['number_ip'])->groupBy('number_ip')->get();
        $allipsNoAuth = Consultasip::all();
        $allipsAuth = Visit::all();


        // ************ NO AUTH *****************************
        foreach ($ipNoAuth as $value) {
            // procedimiento para añadir ubicacion ip en un fichero JSON            
            $verifyIp = SavePlaceTrait::verifyIp($value->number_ip);
            
            if(!$verifyIp){            
                $location = PointOnMapTrait::apiResponse($value->number_ip);
                if(!empty($location))
                    SavePlaceTrait::saveCity($location);
            }
            // =======  
        }

        $complementDataNoAuth = SavePlaceTrait::complementArray($allipsNoAuth, $ipNoAuth, false);

        // ********************** AUTH **************************************
        foreach ($ipAuth as $value) {
            // procedimiento para añadir ubicacion ip en un fichero JSON            
            $verifyIp = SavePlaceTrait::verifyIp($value->number_ip);
            
            if(!$verifyIp){            
                $location = PointOnMapTrait::apiResponse($value->number_ip);
                if(!empty($location))
                    SavePlaceTrait::saveCity($location);
            }
            // =======  
        }

        $complementDataAuth = SavePlaceTrait::complementArray($allipsAuth, $ipAuth, true);       

        // return ['update'=>'Actualizado correctamente','auth'=>$complementDataAuth,'noAuth'=>$complementDataNoAuth];
        return ['update'=>'Actualizado correctamente'];
    }
   

    /**
     * Display the specified resource.
     *
     * @param  string  $visit
     * @return \Illuminate\Http\Response
     */
    public function showNoAuth(string $visit)
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $numberIp = Consultasip::where('number_ip','=',$visit)->orderBy('created_at','DESC')->get();

        return $numberIp;
    }

     /**
     * Display the specified resource.
     *
     * @param  string  $visit
     * @return \Illuminate\Http\Response
     */
    public function showAuth(string $visit)
    {
        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $numberIp = Visit::where('number_ip','=',$visit)->orderBy('created_at','DESC')->get();

        return $numberIp;
    }    
}
