<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use DateTimeInterface;

class Privilege extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','label'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => "d/m/Y H:i",
    ];

     /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('d/m/Y H:i');
    }
    
    /**
     * Relaciona con users
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
