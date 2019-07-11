<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ReservaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('reserva')->insert([
        'id_user' => '2',
        'id_sala' => '3',
        'bloque' => '4',
        'dia_semana' => '1',
        'estado' => '1',
        'fecha_ingreso' => Carbon::parse('2019-07-10'),
        'fecha_salida' => Carbon::parse('2019-07-12'),
      ]);
      DB::table('reserva')->insert([
        'id_user' => '2',
        'id_sala' => '4',
        'bloque' => '4',
        'dia_semana' => '2',
        'estado' => '1',
        'fecha_ingreso' => Carbon::parse('2019-06-11'),
        'fecha_salida' => Carbon::parse('2019-06-30'),
      ]);
      DB::table('reserva')->insert([
        'id_user' => '2',
        'id_sala' => '3',
        'bloque' => '4',
        'dia_semana' => '5',
        'estado' => '1',
        'fecha_ingreso' => Carbon::parse('2019-06-11'),
        'fecha_salida' => Carbon::parse('2019-06-20'),
      ]);
      DB::table('reserva')->insert([
        'id_user' => '2',
        'id_sala' => '2',
        'bloque' => '2',
        'dia_semana' => '4',
        'estado' => '1',
        'fecha_ingreso' => Carbon::parse('2019-05-05'),
        'fecha_salida' => Carbon::parse('2019-07-28'),
      ]);
      DB::table('reserva')->insert([
        'id_user' => '2',
        'id_sala' => '4',
        'bloque' => '2',
        'dia_semana' => '3',
        'estado' => '1',
        'fecha_ingreso' => Carbon::parse('2019-05-05'),
        'fecha_salida' => Carbon::parse('2019-07-28'),
      ]);
    }
}
