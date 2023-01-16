<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert(['nombre'=>'VU','password'=>'VU','unit_id'=>1]);
        DB::table('empleados')->insert(['nombre'=>'VE','password'=>'VE','unit_id'=>2]);
        DB::table('empleados')->insert(['nombre'=>'IN','password'=>'IN','unit_id'=>3]);
        DB::table('empleados')->insert(['nombre'=>'IC','password'=>'IC','unit_id'=>4]);
        DB::table('empleados')->insert(['nombre'=>'EP','password'=>'EP','unit_id'=>5]);
        DB::table('empleados')->insert(['nombre'=>'ME','password'=>'ME','unit_id'=>6]);
    }
}
