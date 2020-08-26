<?php

namespace App\Traits;

class PointOnMapTrait{
    /**
     * Realiza peticion a la API
     * 
     * @param string $ip
     * @return array $location
     */
    public static function apiResponse($ip){       
                
        // Cuando se realiza muchas consultas a la api, se genera un warning
        // Notificar todos los errores excepto E_NOTICE
        error_reporting(E_ALL ^ E_WARNING);
        $location = [];

        $url = 'http://ip-api.com/json/'.$ip;
        $ipMap_json = file_get_contents($url);
        $ipMap_array = json_decode($ipMap_json);
        
        if($ipMap_array && isset($ipMap_array->lat)){
            $location['lat']=$ipMap_array->lat;
            $location['lon']=$ipMap_array->lon;
            $location['city']=$ipMap_array->city;
            $location['zip']=$ipMap_array->zip;
            $location['country']=$ipMap_array->country;
            $location['query']=$ipMap_array->query;            

            return $location;
        }
        return $location;
    }
}     