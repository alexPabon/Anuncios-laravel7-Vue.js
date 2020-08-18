<?php

use Illuminate\Database\Seeder;

use App\models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'otros','formacion y libros','servicios',
            'imagen y sonido','juegos',
            'telefonia','bebes','deporte',
            'moda y complementos','mascotas','motor'
        ];

        foreach ($categories as $value) {
            $us = new Category();
            $us->create(['name'=>$value]);
        }     

    }
}
