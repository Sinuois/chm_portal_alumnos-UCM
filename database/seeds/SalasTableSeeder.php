<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('salas')->insert([
        'nombre' => 'Aula Activa',
        'capacidad' => '25',
      ]);
      DB::table('salas')->insert([
        'nombre' => 'Auditorio Manuel Larrain',
        'capacidad' => '30',
      ]);
      DB::table('salas')->insert([
        'nombre' => 'DCI01',
        'capacidad' => '30',
      ]);
      DB::table('salas')->insert([
        'nombre' => 'DCI02',
        'capacidad' => '30',
      ]);
      DB::table('salas')->insert([
        'nombre' => 'Auditorio Ingenieria',
        'capacidad' => '60',
      ]);
    }
}
