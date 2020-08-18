<?php

namespace App\models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AdvertCategory extends Pivot
{
    
    public function adverts(){
        return $this->belongsTo(Advert::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
