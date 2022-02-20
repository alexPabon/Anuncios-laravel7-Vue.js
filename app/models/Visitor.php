<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * @property integer $id
 * @property string $number_ip
 * @property int $quantity
 * @property string $country
 * @property string $city
 * @property string $latitude
 * @property string $longitude
 */
class Visitor extends Model
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
    protected $table = 'visitors';

    protected $casts =[
        'created_at'=>"date:d/m/Y H:i",
        'updated_at'=>"date:d/m/Y H:i"
    ];

    protected $fillable = ['number_ip', 'quantity', 'country', 'city', 'latitude', 'longitude', 'updated_at'];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i');
    }

    public function seen(){
        return $this->hasMany(Seen::class);
    }
}
