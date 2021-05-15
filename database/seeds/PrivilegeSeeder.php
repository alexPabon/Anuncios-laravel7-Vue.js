<?php

use Illuminate\Database\Seeder;

use App\models\Privilege;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            0=>'suscriptor',
            1000=>'administrador',            
            500=>'colaborador',            
        ];

        foreach ($categories as $key=>$value) {
            $us = new Privilege();
            $us->create([
                'label'=>$key,
                'name'=>$value,                
            ]);
        } 
    }
}
