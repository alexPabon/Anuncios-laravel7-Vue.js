<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateIpLocation;
use App\models\Seen;
use App\models\Visit;
use App\models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\models\Consultasip;

use App\Traits\PointOnMapTrait;
use App\Traits\SavePlaceTrait;

class VisitController extends Controller
{
    public $cont;

    public function __construct()
    {
        $this->middleware('auth');
        $this->cont = 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_no_auth()
    {

        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $seenAuth = Seen::whereNotNull('user_id')->pluck('visitor_id');

        $allVisitorsNoAuth = Visitor::orderBy('updated_at', 'DESC')->whereNotIn('id',$seenAuth)->paginate(10);

        return $allVisitorsNoAuth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_auth()
    {

        if(!isAdmin(Auth::user()->privilege_id))
            abort(403,"No estas autorizado");

        $seenAuth = Seen::whereNotNull('user_id')->pluck('visitor_id');


        $allVisitorsAuth = Visitor::orderBy('updated_at', 'DESC')->whereIn('id',$seenAuth)->paginate(10);

        return $allVisitorsAuth;
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

        $allvisitors = Visitor::orderBy('updated_at','DESC')->whereNull('country')->whereNull('city')->get();

        for($i=0; $i<= intval(($allvisitors->count()/200)); $i++){
            $this->dispatch(new UpdateIpLocation());
        }



        return ['update'=>'Actualizando ips sin informacion de pais, total:'. $allvisitors->count()];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateIps_old()
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

        $numberIp = Visitor::where('number_ip',$visit)->first();
        $numberIp->seen;

        $numberIp->seen->each(function($see){
            $see->user;
        });

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


        $numberIp = Visitor::where('number_ip',$visit)->first();
        $numberIp->seen;

        $numberIp->seen->each(function($see){
            $see->user;
        });

        return $numberIp;
    }
}
