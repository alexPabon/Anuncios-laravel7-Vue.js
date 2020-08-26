<?php

use Illuminate\Database\Seeder;

class ConsultasipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Consultasip::class, 6)->create();
    }
}
