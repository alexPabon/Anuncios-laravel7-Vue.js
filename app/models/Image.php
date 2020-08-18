<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use DateTimeInterface;

class Image extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address','advert_id',
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

    public function advert(){
        return $this->belongsTo(Advert::class);
    }

    /**
     * Encode image a jpg
     * 
     * @param file $valueImage
     * @return file
     */
    public static function encode_jpg($valueImage){
        $imgEncoded = \Intervention\Image\Facades\Image::make($valueImage)->encode('jpg');
        return $imgEncoded;
    }

       /**
     * Encode image a jpg and
     * resize image a width 1350
     * 
     * @param file $valueImage
     * @return file
     */
    public static function resize_img($valueImage){
        $imgResize = \Intervention\Image\Facades\Image::make($valueImage)->encode('jpg');
        $imgResize->resize(640,null,function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();                            
        });

        $imgResize->orientate();
        
        return $imgResize;
    }
}
