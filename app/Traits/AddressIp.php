<?php

namespace App\Traits;

use App\models\Consultasip;
use App\models\Visit;
use Illuminate\Support\Facades\Auth;

trait AddressIp{
    
    /**
     * verifica si el usuario esta autenticado
    */
	public static function guardarIp(){
	    
		// if(Auth::user()){
        //     self::guardarIpAuth();
        // }
        // else{
        //     self::guardarIp_no_Auth();
        // }
        
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