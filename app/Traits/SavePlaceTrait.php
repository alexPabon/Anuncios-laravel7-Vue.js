<?php

namespace App\Traits;

use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\Bool_;
use stdClass;

class SavePlaceTrait{

    protected static $file='files-ips/all-ips.json';
    protected static $file_ip_no_Auth='files-ips/all-ips-no-Auth.json';
    protected static $file_ip_auth='files-ips/all-ips-auth.json';
    

    /**
     * Comprueba si la Ip existe en el fichero JSON
     * 
     * @param string $ip
     * @return bool
     */
    public static function verifyIp(string $ip):bool{
        $allIps_json = file_get_contents(storage_path(self::$file));
        $allips = json_decode($allIps_json);

        if(!empty($allips))
            foreach ($allips as $value) {
                if($value->number_ip==$ip){
                    return true;
                    break;
                }
            }

        return false;
    }   

    /**
     * Abre el fichero y añade los nuevos datos
     * 
     * 
     * @param array $dato
     * @return boolean
     */
    public static function saveCity(array $dato):bool{
        
        $allIps_json = file_get_contents(storage_path(self::$file));
        $allips = json_decode($allIps_json);

        $saveContent['number_ip']= $dato['query'];
        $saveContent['country']= $dato['country'];
        $saveContent['city']= $dato['city'];
        $saveContent['zip']= $dato['zip'];
        $saveContent['lat']= $dato['lat'];
        $saveContent['lon']= $dato['lon'];

        $allips[]=$saveContent;

        $json = json_encode($allips);

        if(file_put_contents(storage_path(self::$file),$json))
            return true;        
            
        return false;   
    }

    /**
     * Crea un fichero JSON con los datos de la ubicacion de 
     * la ip.
     * 
     * @param object $visitsIp
     * @param object $visitGroup
     * @param bool $isAuth
     * 
     * @return array
     */
    public static function complementArray(object $visitsIp, object $visitGroup, bool $isAuth=false){
        $allIps_json = file_get_contents(storage_path(self::$file));
        $allips = json_decode($allIps_json);        

        $allipsCities = [];

        foreach ($visitGroup as $group) {            
            
            $addData = [];

            foreach ($allips as $value) {
                if($group->number_ip==$value->number_ip){
                    
                    $contador = 0;

                    $addData=[
                        'number_ip'=>$value->number_ip,
                        'country'=>$value->country,
                        'city'=>$value->city,
                        'zip'=>$value->zip,
                        'lat'=>$value->lat,
                        'lon'=>$value->lon,
                    ];
                    
                    $createdAt = '';

                    foreach ($visitsIp as $valueIp) {
                        if($group->number_ip==$valueIp->number_ip){

                            if($createdAt<$valueIp->created_at)
                                $createdAt = $valueIp->created_at;

                            $contador++;
                        }
                    }

                    $addData['cant'] = $contador;
                    $addData['created_at'] = $createdAt->format('d-m-Y H:i');

                    $allipsCities[]=$addData;
                    break;
                }
            }            
        }

        $json = json_encode($allipsCities);

        if($isAuth)
            file_put_contents(storage_path(self::$file_ip_auth), $json);
        else
            file_put_contents(storage_path(self::$file_ip_no_Auth),$json);

        return $allipsCities;

    }

    /**
     * Abre los dos ficheros JSON y los decofica para poder leer en php
     * 
     * @return array
     */
    public static function searchAllips(){

        $allIps_no_Auth = file_get_contents(storage_path(self::$file_ip_no_Auth));
        $noAuth = json_decode($allIps_no_Auth);
        
        $allIps_Auth = file_get_contents(storage_path(self::$file_ip_auth));
        $allAuth = json_decode($allIps_Auth);

        return ['auth'=>$allAuth, 'noAuth'=>$noAuth];
    }
}