<?php

namespace App;

use App\models\Seen;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\verifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail as NotificationsVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\models\Advert;
Use App\models\Privilege;
use DateTimeInterface;

/**
 * @property integer $id
 * @property string $name
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','phone', 'password','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','update_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(){
        $this->notify(new verifyEmail());
    }

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
     * Relacionar user con advert
     */
    public function adverts(){
        return $this->hasMany(Advert::class);
    }

    /**
     * Relacion con privileges
     */
    public function privilege(){
        return $this->belongsTo(Privilege::class);
    }

    public function seen(){
        return $this->hasMany(Seen::class);
    }
}
