<?php

namespace App\Traits;

use App\models\Consultasip;
use App\models\Seen;
use App\models\Visit;
use App\models\Visitor;
use Illuminate\Support\Facades\Auth;

trait AddressIp{

    /**
     * verifica si el usuario esta autenticado
    */
	public static function guardarIp(){

        $direccionIP = $_SERVER['REMOTE_ADDR'];
        $nombreModulo = $_SERVER['REQUEST_URI'];
        $visitor = Visitor::where('number_ip',$direccionIP)->first();
        $user = Auth::user();
//dd($direccionIP);
        if(!$visitor){

            $visitor = new Visitor();
            $visitor->number_ip = $direccionIP;
            $visitor->save();

            $seen = new Seen();
            $seen->visitor_id = $visitor->id;
            $seen->user_id = $user->id??null;

            $seen->address = $nombreModulo;

            $seen->save();

        }else{

            $visitor->quantity = ($visitor->quantity+1);
            $visitor->update();

            $seen = Seen::where([
                'visitor_id' => $visitor->id,
                'user_id' => $user->id??null,
                'address' => $nombreModulo,
            ])->first();

            if($seen){

                $seen->quantity = ($seen->quantity+1);
                $seen->update();

            }else{

                $seen = new Seen();
                $seen->visitor_id = $visitor->id;
                $seen->user_id = $user->id??null;

                $seen->address = $nombreModulo;
                $seen->save();
            }



        }
    }

    /**
     * Guarda la ip en la tabla de los usuarios no
     * autenticados
     *
     * tabla Consultasips database database.sqlite
     *
    */
    protected static function guardarIp_no_Auth(){

        $direccionIP = $_SERVER['REMOTE_ADDR'];
        $nombreModulo = $_SERVER['REQUEST_URI'];

        $saveIp = new Consultasip();
        $saveIp->number_ip = $direccionIP;
        $saveIp->address = $nombreModulo;

        if(!$saveIp->save())  //guardar en la BDD
           abort(409,"Se produjo un Error");
    }

    /**
     * Guarda la ip en la tabla de los usuarios no
     * autenticados
     *
     * tabla Visits database MySQL
    */
    protected static function guardarIpAuth(){

        $direccionIP = $_SERVER['REMOTE_ADDR'];
        $nombreModulo = $_SERVER['REQUEST_URI'];


        $saveIp = new Visit();
        $saveIp->number_ip = $direccionIP;
        $saveIp->address = $nombreModulo;
        $saveIp->user_name = Auth::user()->name;
        $saveIp->email = Auth::user()->email;

        if(!$saveIp->save())  //guardar en la BDD
           abort(409,"Se produjo un Error");
    }
}
