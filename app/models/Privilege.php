<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Privilege extends Model
{
    
    /**
     * Relaciona con users
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
