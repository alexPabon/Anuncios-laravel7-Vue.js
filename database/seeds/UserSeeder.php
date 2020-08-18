<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Factory(App\User::class, 5)->create();

        // factory(App\User::class, 2)->create()->each(function ($user) {
        //     for($i=0; $i<5;$i++)
        //         $user->adverts()->save(factory(App\models\Advert::class)->make())->each(function($advert){
        //             Factory(App\models\Image::class, 3)->create(['advert_id'=>$advert->id]);
        //             $advert->categories()->sync([1,3]);
        //         });
        // });

        factory(App\User::class,10)->create()->each(function($user){
            factory(App\models\Advert::class,30)->create(['user_id'=>$user->id])->each(function($advert){                
                $advert->categories()->sync([1,2,6]);
            });
        });
    }
}

