<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Consultasip extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'consultasips';

    protected $casts =[
        'created_at'=>"date:d/m/Y H:i",
        'updated_at'=>"date:d/m/Y H:i"
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i');
    }
}
