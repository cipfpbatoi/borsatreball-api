<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oferta;

class OfertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Oferta::create(['id'=>1,'id_empresa'=>'5','validada'=>1,'any'=>'2018','estudiando'=>1,
            'activa'=>'1']);

    }
}