<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert(['nombre'=>'VENTANILLA UNICA','abreviatura'=>'VU','color'=>'#1F7087']);
        DB::table('units')->insert(['nombre'=>'VEHICULOS','abreviatura'=>'VE','color'=>'#952175']);
        DB::table('units')->insert(['nombre'=>'INMUEBLES','abreviatura'=>'IN','color'=>'#1F7087']);
        DB::table('units')->insert(['nombre'=>'INDUSTRI COMERCIO','abreviatura'=>'IC','color'=>'#952175']);
        DB::table('units')->insert(['nombre'=>'ESPEC. PUBLICOS','abreviatura'=>'EP','color'=>'#1F7087']);
        DB::table('units')->insert(['nombre'=>'MERCADOS','abreviatura'=>'ME','color'=>'#952175']);
        DB::table('units')->insert(['nombre'=>'VALORES','abreviatura'=>'VA','color'=>'#1F7087']);
        DB::table('units')->insert(['nombre'=>'BANCO','abreviatura'=>'BA','color'=>'#952175']);
    }
}
