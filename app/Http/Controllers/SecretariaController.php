<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Salas;
use App\Reserva;
use App\User;
use App\Destinatario;
use App\InscripcionesTesis;
use App\SubirArchivo;
use PDF;
use Mail;
use App\Mail\MailMensaje;


class SecretariaController extends Controller
{

    public function index()
    {
        $secretaries = User::All();
        return view('Secretaria.index', compact('secretaries'));
    }

    public function formulario_correo()
    {
      Destinatario::truncate(); //Cada vez que se entre al formulario, se borran los destinatarios almacenados
      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      $destinatarios = Destinatario::All();
      return view('Secretaria.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function agregar_destinatario($nombre, $correo)
    {      
      $chequeo_existencia = Destinatario::where('correo', '=', $correo)->first(); //Ver si existe algún elemento repetido
      if ($chequeo_existencia === null) { //Si no hay ninguno repetido, crear nuevo
        $destinatario = new Destinatario;
        $destinatario->nombre = $nombre;
        $destinatario->correo = $correo;
        $destinatario->save();
      }

      $destinatarios = Destinatario::All();

      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      return view('Secretaria.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function borrar_destinatario($id) {
      $destinatario = \App\Destinatario::find($id);
      $destinatario->delete();
      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      $destinatarios = Destinatario::All();
      return view('Secretaria.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function enviar_correo(Request $request)
    {
      $destinatarios = Destinatario::pluck('correo'); //Obtener un arreglo de correos, sacados de la tabla de destinatarios
      Mail::to($destinatarios)->send(new MailMensaje($request->input('mensaje')));
      return view('\home');
    }

    public function listado_reservas()
    {
      $reserva = DB::table('reserva')
                    ->join('salas', 'salas.id', '=','reserva.id_sala')
                    ->select('reserva.id','reserva.id_user','salas.nombre', 'reserva.bloque','reserva.dia_semana' ,'reserva.estado', 'reserva.fecha_ingreso','reserva.fecha_salida')
                    ->get();
         return view('Secretaria.listado_reservas')->with('reserva', $reserva);
    }
    public function listado_salas()
    {
         $salas = Salas::orderBy('id')->paginate(10);
         return view('Secretaria.listado_salas')->with('salas', $salas);
    }

    public function confirmar_listado_reservas()
    {
        $reserva = Reserva::orderBy('id','ASC')->paginate(6);
         return view('Secretaria.confirmar_listado_reservas')->with('reserva', $reserva);
    }
    public function agregar_sala(Request $request)
    {
      $agregar = new Salas;
      $agregar->nombre = $request->input('nombre_sala');
      $agregar->capacidad = $request->input('capacidad');
      $agregar ->save();
      return redirect('/secretaria_agregar_sala')->with('status_sala', 'Se ha ingresado la Sala correctamente');
    }

    public function buscar_disponibilidad(Request $request)
    {
      $dia_semana = $request->dia_semana;
      $fi = $request->fecha_ingreso;
      $ff = $request->fecha_salida;
      $fi=date("Y-m-d", strtotime($fi));
      $ff=date("Y-m-d", strtotime($ff));
      $reservas = DB::table('reserva')
                      ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                      ->select('reserva.id','reserva.id_sala','reserva.dia_semana','reserva.bloque')
                      ->where([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                          ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                          ])
                      ->orwhere([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                          ['reserva.fecha_salida', '>', $request->fecha_salida],
                          ])
                      ->orwhere([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                          ['reserva.fecha_salida', '=', $request->fecha_salida],
                          ])
                       ->orwhere([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                          ])
                       ->orwhere([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_salida', '=', $request->fecha_salida],
                          ])
                       ->orwhere([
                          ['reserva.dia_semana', '=', $request->dia_semana],
                          ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                          ['reserva.fecha_salida', '<', $request->fecha_salida],
                        ])
                      ->get();
       $salas = DB::table('salas')
                     ->select('salas.id', 'salas.nombre', 'salas.capacidad')
                     ->get();
      $bloques = array();
      $i = 0;
      if ($request->bloque_1 == 1) {
        $bloques[$i] = $request->bloque_1;

        $i++;
      }
      if ($request->bloque_2 == 2) {
        $bloques[$i] = $request->bloque_2;
        $i++;
      }
      if ($request->bloque_3 == 3) {
        $bloques[$i] = $request->bloque_3;
        $i++;
      }
      if ($request->bloque_4 == 4) {
        $bloques[$i] = $request->bloque_4;
        $i++;
      }
      if ($request->bloque_5 == 5) {
        $bloques[$i] = $request->bloque_5;
        $i++;
      }
      if ($request->bloque_6 == 6) {
        $bloques[$i] = $request->bloque_6;
        $i++;
      }
      if ($request->bloque_7 == 7) {
        $bloques[$i] = $request->bloque_7;
        $i++;
      }
      if ($request->bloque_8 == 8) {
        $bloques[$i] = $request->bloque_8;
        $i++;
      }
      if ($request->bloque_9 == 9) {
        $bloques[$i] = $request->bloque_9;
      }

     //dd($bloques[0]);

         // return $bloques;
       if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
         // return $clon;
          return view('Secretaria.resultado_busqueda', compact('bloques', 'reservas','salas','fi','ff','dia_semana'));
       }
       else{
           return redirect('/secretaria_buscar_disponibilidad')->with('error_reserva', 'Ingrese fecha correctamente');
      }
    }

    public function agregar_reserva(Request $request)
    {
     $id_sala = DB::table('salas')
                   ->select('salas.id','salas.nombre')
                   ->where('salas.nombre', $request->nombre_sala)
                   ->get();

      if ($request->bloque_1 == 1){
         $reserva = DB::table('reserva')
                         ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                         ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                         ->where([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                             ['reserva.fecha_salida', '>', $request->fecha_salida],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '<', $request->fecha_salida],
                           ])
                         ->get();
                         $cuenta =$reserva->count();
                         if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                            if( $cuenta == 0){
                                         $reserva = new Reserva();
                                         $reserva->id_user = $request->id_user;
                                         $reserva->id_sala = $id_sala[0]->id;
                                         $reserva->bloque = $request->bloque_1;
                                         $reserva->estado = $request->estado;
                                         $reserva->dia_semana = $request->dia_semana;
                                         $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                         $reserva->fecha_salida = $request->input('fecha_salida');
                                         $reserva->save();
                              }
                              else {
                                return redirect('/secretaria_reserva')->with('error_reserva', ' Sala ocupada en el bloque 1');
                              }
                         }
                         else{
                             return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                        }
          }
          if ($request->bloque_2 == 2){
            $reservas = DB::table('reserva')
                            ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                            ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                            ->where([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                                ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                                ])
                            ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                                ['reserva.fecha_salida', '>', $request->fecha_salida],
                                ])
                            ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                                ['reserva.fecha_salida', '=', $request->fecha_salida],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_salida', '=', $request->fecha_salida],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.dia_semana', '=', $request->dia_semana],
                                ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                                ['reserva.fecha_salida', '<', $request->fecha_salida],
                              ])
                            ->get();
                            $cuenta =$reservas->count();
                            if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                               if( $cuenta == 0){
                                            $reserva = new Reserva();
                                            $reserva->id_user = $request->id_user;
                                            $reserva->id_sala = $id_sala[0]->id;
                                            $reserva->bloque = $request->bloque_2;
                                            $reserva->estado = $request->estado;
                                            $reserva->dia_semana = $request->dia_semana;
                                            $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                            $reserva->fecha_salida = $request->input('fecha_salida');
                                            $reserva->save();
                                 }
                                 else {
                                  return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 2');
                                 }
                            }
                            else{
                              return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                            }
        }
       if ($request->bloque_3 == 3){
         $reservas = DB::table('reserva')
                         ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                         ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                         ->where([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                             ['reserva.fecha_salida', '>', $request->fecha_salida],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.dia_semana', '=', $request->dia_semana],
                             ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '<', $request->fecha_salida],
                           ])
                         ->get();
                         $cuenta =$reservas->count();
                         if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                            if( $cuenta == 0){
                                         $reserva = new Reserva();
                                         $reserva->id_user = $request->id_user;
                                         $reserva->id_sala = $id_sala[0]->id;
                                         $reserva->bloque = $request->bloque_3;
                                         $reserva->estado = $request->estado;
                                         $reserva->dia_semana = $request->dia_semana;
                                         $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                         $reserva->fecha_salida = $request->input('fecha_salida');
                                         $reserva->save();
                              }
                              else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 3');
                              }
                         }
                         else{
                           return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                         }
        }
        if ($request->bloque_4 == 4){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_4;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 4');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_5 == 5){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_5;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 5');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_6 == 6){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_6;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 6');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_7 == 7){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_7;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 7');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_8 == 8){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_8;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 8');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_9 == 9){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.dia_semana', '=', $request->dia_semana],
                              ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '<', $request->fecha_salida],
                            ])
                          ->get();
                          $cuenta =$reservas->count();
                          if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {
                             if( $cuenta == 0){
                                          $reserva = new Reserva();
                                          $reserva->id_user = $request->id_user;
                                          $reserva->id_sala = $id_sala[0]->id;
                                          $reserva->bloque = $request->bloque_9;
                                          $reserva->estado = $request->estado;
                                          $reserva->dia_semana = $request->dia_semana;
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/secretaria_reserva')->with('error_reserva', 'Sala ocupada en el bloque 9');
                               }
                          }
                          else{
                            return redirect('/secretaria_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        return redirect('/secretaria_reserva')->with('status_reserva', 'Se ha ingresado la Reserva correctamente');

   }

    public function comentario(Request $request)
    {
      $reserva = Reserva::find($request->id_reserva);
      $reserva-> id_user = $request->id_user;
      $reserva-> estado = '3';
      $reserva-> comentario = $request->comentario;
      $reserva->save();
      return redirect()->route('listado_reservas');

    }
    public function show2($id, $fi, $ff, $nombre, $capacidad, $dia_semana)
    {
        return view('Secretaria.reserva_busqueda', compact('id','fi','ff','nombre','capacidad','dia_semana'));
    }
    public function show($id)
    {
        return view('Secretaria.edit_reserva');
    }

    public function edit($id)
    {
        $reserva = Reserva::find($id);//busca la id recibida en la base de datos
        return view('secretaria.confirmar_reserva')->with('reserva', $reserva);
    }
    public function notificacion($id)
    {
        $reserva = Reserva::find($id);//busca la id recibida en la base de datos
        return view('secretaria.notificacion')->with('reserva', $reserva);
    }

    public function edit_reserva($id)
    {
        $reserva = Reserva::find($id);//busca la id recibida en la base de datos
        return view('secretaria.editar_reserva')->with('reserva', $reserva);
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::find($id);
        $reserva-> id_user = $request->id_user;
        $reserva-> id_sala = $request->id_sala;
        $reserva-> bloque = $request->bloque;
        $reserva-> estado = $request->estado;
        $reserva-> dia_semana = $request->dia_semana;
        $reserva-> fecha_ingreso = $request->input('fecha_ingreso');
        $reserva-> fecha_salida = $request->input('fecha_salida');
        $reserva->save();
        return redirect()->route('listado_reservas');
    }

    public function destroy($id)
    {
      $reserva = Reserva::find($id); //Esta funcion elimina la reserva seleccionado
      $reserva -> delete();
      return redirect()->route('listado_reservas');
    }

    public function destroy_confirmar_reserva($id)
    {
      $reserva = Reserva::find($id); //Esta funcion elimina la reserva seleccionado
      $reserva -> delete();
      return redirect()->route('confirmar_listado_reservas');
    }

    public function destroysala($id)
    {
      $sala = Salas::find($id); //Esta funcion elimina la sala seleccionado
      $sala -> delete();
      return redirect()->route('listado_salas');
    }
     public function inscripcionestesis()
    {

      $inscripciones = DB::table('inscripciones_tesis')->get();
      
  
     // $inscripciones = InscripcionesTesis::All();
      // dd($inscripcion);
        return view ('Secretaria.InscripcionesTesis', compact('inscripciones'));
    }

  public function imprimir_formulario($id){ 

  //  dd($id);
    $d_inscripcion = DB::table('inscripciones_tesis')->where('id',$id)->get();
     // $inscripciones = DB::table('inscripciones_tesis')->get();

     foreach ($d_inscripcion as $inscripcion ) {
      $alumno=$inscripcion->Alumno_id;
      $profesor=$inscripcion->Profesor_id;
     }
     $d_alumno = DB::table('users')->where('id', $alumno)->get();
     $d_profesor = DB::table('users')->where('id', $profesor)->get();
 
      $pdf = \PDF::loadView('Secretaria.formulario_inscripcion',compact('d_inscripcion','d_alumno','d_profesor'));
      return $pdf->download('Formulario_pdf.pdf');
  }

  public function imprimir_acta($id){ 

  //  dd($id);
    $d_inscripcion = DB::table('inscripciones_tesis')->where('id',$id)->get();
     // $inscripciones = DB::table('inscripciones_tesis')->get();

     foreach ($d_inscripcion as $inscripcion ) {
      $alumno=$inscripcion->Alumno_id;
      $profesor=$inscripcion->Profesor_id;
     }
     $d_alumno = DB::table('users')->where('id', $alumno)->get();
     $d_profesor = DB::table('users')->where('id', $profesor)->get();
 
      $pdf = \PDF::loadView('Secretaria.acta_pdf',compact('d_inscripcion','d_alumno','d_profesor'));
      return $pdf->download('Acta_pdf.pdf');
  }

  public function buscar(Request $request){ 
    
    $rut= $request->input('rut');
    $usuarios = DB::table('users')->get();
    $id_user;
    $cont=0;
    #

    foreach ($usuarios as $usuario) {

      if ( $usuario->rut==$rut) {
        $id_user=$usuario->id;
        $user = DB::table('inscripciones_tesis')->where('Alumno_id',$id_user)->get();

        $cont=$cont+1;
      }

    }

    if($cont > 0)
        return view('Secretaria.busqueda')->withDetails($user)->withQuery ( $rut );
    else return view ('Secretaria.busqueda')->withMessage('No hay resultados');
   
  }

   public function filtrar(Request $request){ 


    $inicio= $request->input('fecha_inicio');
    $final= $request->input('fecha_final');
    $inscripciones = DB::table('inscripciones_tesis')->whereBetween('FechaInscripcion', [$inicio, $final])->get();
    return view ('Secretaria.filtrado', compact('inscripciones','inicio','final'));
  }

 public function subirArchivo(Request $request)
 {
        //Recibimos el archivo y lo guardamos en la carpeta storage/app/public
        $dato = $request->file('archivo')->store('public');

    return redirect('/secretaria');
        
 }
    public function reportes_reservas()
    {
      $reserva = DB::table('reserva')
                    ->join('salas', 'salas.id', '=','reserva.id_sala')
                    ->select('reserva.id','reserva.id_user','salas.nombre', 'reserva.bloque','reserva.dia_semana' ,'reserva.estado', 'reserva.fecha_ingreso','reserva.fecha_salida')
                    ->get();
      $pdf = PDF::loadView('Secretaria.reporte_reservas', compact('reserva'));
      return $pdf->stream('reservas.pdf');
    }

    public function historial_sala($id)
    {
      $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('reserva.id_sala','salas.nombre','salas.capacidad','reserva.dia_semana','reserva.bloque','reserva.estado','reserva.fecha_ingreso','reserva.fecha_salida')
                          ->where('reserva.id_sala', $id)
                          ->get();
      $cuenta =$reservas->count();
      return view('Secretaria.historial_sala', compact('reservas','cuenta','id'));
    }

    public function exportar_sala($id)
    {
      $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('reserva.id_sala','salas.nombre','salas.capacidad','reserva.dia_semana','reserva.bloque','reserva.estado','reserva.fecha_ingreso','reserva.fecha_salida')
                          ->where('reserva.id_sala', $id)
                          ->get();
      $pdf = PDF::loadView('Secretaria.exportar_historial', compact('reservas'));
      return $pdf->stream('historial_sala.pdf');
    }
}
