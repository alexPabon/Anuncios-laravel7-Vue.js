<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use DateTimeInterface;

class Category extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at'
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

    public function adverts(){
        return $this->belongsToMany(Advert::class);            
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
