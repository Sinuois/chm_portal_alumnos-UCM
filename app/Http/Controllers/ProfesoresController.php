<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Salas;
use App\Reserva;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\InscripcionesTesis;


class ProfesoresController extends Controller
{
    public function index()
    {
        $professors = User::All();
        return view('Profesores.index', compact('professors'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function listado_reservas()
    {
        $reserva = Reserva::orderBy('id','ASC')->paginate(6);
         return view('Profesores.listado_reservas')->with('reserva', $reserva);
    }

    public function agregar_reserva(Request $request)
    {
     $id_sala = DB::table('salas')
                   ->select('salas.id')
                   ->where('salas.nombre', $request->nombre_sala)
                   ->get();




      if ($request->bloque_1 == 1){
         $reserva = DB::table('reserva')
                         ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                         ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                         ->where([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                             ['reserva.fecha_salida', '>', $request->fecha_salida],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_1],
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
                                         $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                         $reserva->fecha_salida = $request->input('fecha_salida');
                                         $reserva->save();
                              }
                              else {
                                return redirect('/profesores_reserva')->with('error_reserva', ' Sala ocupada en el bloque 1');
                              }
                         }
                         else{
                             return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                        }
          }
          if ($request->bloque_2 == 2){
            $reservas = DB::table('reserva')
                            ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                            ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                            ->where([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                                ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                                ])
                            ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                                ['reserva.fecha_salida', '>', $request->fecha_salida],
                                ])
                            ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                                ['reserva.fecha_salida', '=', $request->fecha_salida],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
                                ['reserva.fecha_salida', '=', $request->fecha_salida],
                                ])
                             ->orwhere([
                                ['salas.id', '=',$id_sala[0]->id],
                                ['reserva.bloque', '=', $request->bloque_2],
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
                                            $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                            $reserva->fecha_salida = $request->input('fecha_salida');
                                            $reserva->save();
                                      //  return view('reserva.guardado');
                                 }
                                 else {
                                  return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 2');
                                 }
                            }
                            else{
                              return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                            }
        }
       if ($request->bloque_3 == 3){
         $reservas = DB::table('reserva')
                         ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                         ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                         ->where([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                             ['reserva.fecha_salida', '>', $request->fecha_salida],
                             ])
                         ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
                             ['reserva.fecha_salida', '=', $request->fecha_salida],
                             ])
                          ->orwhere([
                             ['salas.id', '=',$id_sala[0]->id],
                             ['reserva.bloque', '=', $request->bloque_3],
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
                                         $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                         $reserva->fecha_salida = $request->input('fecha_salida');
                                         $reserva->save();
                                   //  return view('reserva.guardado');
                              }
                              else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 3');
                              }
                         }
                         else{
                           return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                         }
        }
        if ($request->bloque_4 == 4){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
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
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_4],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 4');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_5 == 5){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_5],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 5');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_6 == 6){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_6],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 6');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_7 == 7){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_7],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 7');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_8 == 8){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_8],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 8');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        if ($request->bloque_9 == 9){
          $reservas = DB::table('reserva')
                          ->join('salas', 'salas.id', '=', 'reserva.id_sala')
                          ->select('salas.id','salas.nombre', 'salas.capacidad', 'reserva.bloque')
                          ->where([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                              ['reserva.fecha_salida', '>', $request->fecha_salida],
                              ])
                          ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
                              ['reserva.fecha_salida', '=', $request->fecha_salida],
                              ])
                           ->orwhere([
                              ['salas.id', '=',$id_sala[0]->id],
                              ['reserva.bloque', '=', $request->bloque_9],
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
                                          $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                          $reserva->fecha_salida = $request->input('fecha_salida');
                                          $reserva->save();
                                    //  return view('reserva.guardado');
                               }
                               else {
                                return redirect('/profesores_reserva')->with('error_reserva', 'Sala ocupada en el bloque 9');
                               }
                          }
                          else{
                            return redirect('/profesores_reserva')->with('error_reserva', 'Ingrese fecha correctamente');
                          }
        }
        return redirect('/profesores_reserva')->with('status_reserva', 'Se ha ingresado la Reserva correctamente');

   }
    //---------------------------------------------------------------------------------------------7
   //CONTROLADORES INSCRIPCION DE TESIS


       public function index()
    {
        $professors = User::All();

        $id_profesor = Auth::user()->id;
        $inscripciones = DB::table('inscripciones_tesis')->where('Profesor_id', $id_profesor)->get();

        //dd($inscripciones);
        return view('Profesores.index', compact('professors','inscripciones'));

    }



    public function inscripcionestesis($id)
    {

       $id_profe = Auth::user()->id;

       $inscripcion = new InscripcionesTesis;


        $inscripciones = DB::table('inscripciones_tesis')->where('id', $id)->get();
      //  dd($inscripciones);

        foreach ($inscripciones as $inscripcion1) {
          $inscripcion=$inscripcion1;

        }

        $id_director = $inscripcion->Director_id;
        $id_alumno = $inscripcion->Alumno_id;

        $profesor = DB::table('users')->where('id', $id_profe)->get();

        $alumno = DB::table('users')->where('id', $id_alumno)->get();
        $director = DB::table('users')->where('id', $id_director)->get();






        return view ('Profesores.InscripcionTesis', compact('inscripciones','profesor','alumno','director'));

    }



    public function listadotesis()
    {
       $inscripciones = new InscripcionesTesis;
        $id = Auth::user()->id;

          $inscripciones = DB::table('inscripciones_tesis')->where('Profesor_id', $id)->paginate(6);
      // dd($inscripcion);
        return view ('Profesores.Detalles', compact('inscripciones'));

    }



     public function guardarinscripcionestesis(Request $request)
    {
        $inscripcion = new InscripcionesTesis;
        $id_inscripcion = $request->input('id');


        DB::table('inscripciones_tesis')
            ->where('id', $id_inscripcion)
            ->update(array( 'comision1' => $request->input('comision1'),
             'comision2' => $request->input('comision2'),
             'comision3' => $request->input('comision3'),
             'estado' => $request->input('estado'),
             'estado' => ('Pendiente-D'),
        ));


       return redirect('/profesor');
    }
}
