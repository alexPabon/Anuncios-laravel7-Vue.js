<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * @property integer $id
 * @property int $visitor_id
 * @property int $user_id
 * @property string $address
 * @property string $quantity
 */
class Seen extends Model
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
    protected $table = 'seen';

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

    public function visitor(){
        return $this->belongsTo(Visitor::class);
    }

    public function user(){
        $this->connection = env('DB_CONNECTION', 'mysql');
        return $this->belongsTo(User::class);
    }
}
