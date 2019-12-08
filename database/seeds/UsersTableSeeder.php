    
<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('users')->insert([ 
        'rut' => '0000000',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombres Estudiante',
        'apellidos' => 'Apellidos Estudiante',
        'email' => 'estudiante@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'fecha_ingreso' => Carbon::parse('2015-01-01'),
        'tipo_usuario' => 'estudiante',
      ]);
      DB::table('users')->insert([ 
        'rut' => '1111111',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombres Profesor',
        'apellidos' => 'Apellidos Profesor',
        'email' => 'profesor@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'cargo' => 'Cargo Ejemplo',
        'departamento' => 'Departamento Ejemplo',
        'tipo_usuario' => 'profesor',
      ]);
      DB::table('users')->insert([ 
        'rut' => '2222222',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombres Director',
        'apellidos' => 'Apellidos Director',
        'email' => 'director@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'tipo_usuario' => 'director',
      ]);
      DB::table('users')->insert([ 
        'rut' => '3333333',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombres Empresa',
        'apellidos' => 'NE',
        'email' => 'empresa@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'tipo_usuario' => 'empresa',
      ]);
      DB::table('users')->insert([ 
        'rut' => '4444444',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombres Secretaria',
        'apellidos' => 'Apellidos Secretaria',
        'email' => 'secretaria@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'tipo_usuario' => 'secretaria',
      ]);
      DB::table('users')->insert([ 
        'rut' => '5555555',
        'password' => bcrypt('123456789'),
        'nombres' => 'Estudiante 2',
        'apellidos' => 'Apellidos Estudiante 2',
        'email' => 'estudiante2@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'fecha_ingreso' => Carbon::parse('2015-01-01'),
        'tipo_usuario' => 'estudiante',
      ]);
      DB::table('users')->insert([ 
        'rut' => '6666666',
        'password' => bcrypt('123456789'),
        'nombres' => 'Estudiante 3',
        'apellidos' => 'Apellidos Estudiante',
        'email' => 'apellido6@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'tipo_usuario' => 'director',
      ]);
      DB::table('users')->insert([ 
        'rut' => '7777777',
        'password' => bcrypt('123456789'),
        'nombres' => 'Estudiante 4',
        'apellidos' => 'Apellidos Estudiante 4',
        'email' => 'estudiante4@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'cargo' => 'Cargo Ejemplo',
        'departamento' => 'Departamento Ejemplo',
        'tipo_usuario' => 'profesor',
      ]);
      DB::table('users')->insert([ 
        'rut' => '8888888',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombre Empresa 2',
        'apellidos' => 'NE',
        'email' => 'empresa2@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'cargo' => 'Cargo Ejemplo',
        'departamento' => 'Departamento Ejemplo',
        'tipo_usuario' => 'profesor',
      ]);
      DB::table('users')->insert([ 
        'rut' => '9999999',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombre Empresa 3',
        'apellidos' => 'NE',
        'email' => 'empresa3@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'tipo_usuario' => 'empresa',
      ]);
      DB::table('users')->insert([ 
        'rut' => '11111111',
        'password' => bcrypt('123456789'),
        'nombres' => 'Nombre Empresa 4',
        'apellidos' => 'NE',
        'email' => 'empresa4@gmail.com',
        'direccion_actual' => 'Calle Ejemplo',
        'direccion_procedencia' => 'Pasaje Ejemplo',
        'telefono' => '72111111',
        'celular' => '911111111',
        'foto' => '',
        'cargo' => 'Cargo Ejemplo',
        'departamento' => 'Departamento Ejemplo',
        'tipo_usuario' => 'profesor',
      ]);
    }
}