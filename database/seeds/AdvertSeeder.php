<?php

use App\models\Image;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Advert::class, 3)->create()->each(function ($advert) {
            
            Factory(App\models\Image::class, 10)->create(['advert_id'=>$advert->id]);
        });
    }
}
