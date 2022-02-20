<?php

namespace App\Http\Controllers;

use App\Traits\AddressIp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function iniMaster(){
        AddressIp::guardarIp();
        return view('layouts.master');
    }

    public function master(){

        return view('layouts.master');
    }

    public function apiUser(Request $request){
        return $request->user();
    }

    public function migrateTable(){
        $msn = 'Migracion correcta!';
        if(!Artisan::call('migrate:fresh --force'))
            $msn = 'Error al migrar!';

        return $msn;
    }

    public function generateMigration(){

        $msn = 'Migracion correcta!';
        if(!Artisan::call('migrate:fresh --force'))
            $msn = 'Error al migrar!';

        return $msn;

    }

    public function artisanCommand($word){

        $msn = 'No hay coincidencias!';

        switch ($word){

            case 'migrate':
                Artisan::call('migrate --force');
                $msn = 'Migracion correcta!';
                break;
            case 'work':
                Artisan::call('queue:work --timeout=120');
                $msn = 'Ejecutando las colas de trabajo!';
                break;
            case 'links':
                Artisan::call('storage:link');
                $msn = 'Se ha creado el link simbolico!';
                break;
            case 'maintenance':
                Artisan::call('down',['--message'=>'Estamos realizando unos pequeños cambios, intentelo mas tarde.','--allow'=>'90.68.219.200']);
                $msn = 'En mantenimiento!';
                break;
            case 'update-ips':
                Artisan::call('register:ip');
                $msn = 'Actualizado las ips!';
                break;
            case 'storage':
                Artisan::call('storage:link');
                $msn = 'link simbolico correcto!';
                break;

        }

        return $msn;

    }
}
