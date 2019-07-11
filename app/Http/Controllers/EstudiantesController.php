<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Practicasprofesionale;
use App\PostulacionesPractica;
use App\InscripcionesTesis;
use Carbon\Carbon;

class EstudiantesController extends Controller
{
    public function index(request $request)
    {
        //dd($request->all()); // muestra el contenido del request
        $students = User::All();
        return view('Estudiantes.index', compact('students'));
    }

    public function solicitud_practica(Request $request)
    {
        $datos = new PostulacionesPractica;
        $datos->practicaid = $request->idpractica;
        $datos->alumnoid = $request->idalumno;
        $datos->fecha = '01-01-01';
        $datos->estado = 'Pendiente';

        $datos->save();
        return redirect(route('CatPag'));
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

    public function catalogopracticas()
    {
        $estudiante=Auth::user();
        $practica_en_curso=PostulacionesPractica::where('alumnoid','=',$estudiante->id)->pluck('practicaid');
        $Coleccion= Practicasprofesionale:: where('Estado', '=', 'Aprobado')->
                                            whereNotIn('id',$practica_en_curso)->
                                            orderBy('updated_at', 'desc')->
                                            paginate(5);
        return view('Estudiantes.CatalogoPractica',compact('Coleccion'));
    }

    public function practicasdetalle(Request $request)
    {
        $Practicas= Practicasprofesionale:: where('Estado', '=', 'Aprobado')
                                    ->where('id',$request->id)
                                    ->get();

        return view ('Estudiantes.PracticasDetalle', compact('Practicas'));
    }
    //controladores de inscripcionde tesis



 public function inscripcionestesis(Request $request)
    {


        $profesores = DB::table('users')->where('tipo_usuario', 'profesor')->get();
        $directores = DB::table('users')->where('tipo_usuario', 'director')->get();


        return view ('Estudiantes.inscripciontesis', compact('profesores','directores'));
    }


      public function listado()
    {
        $estudiante=Auth::user();
        $inscripciones = DB::table('inscripciones_tesis')->where('Alumno_id', $estudiante->id)->get();

        $contador=count($inscripciones);
        return view ('Estudiantes.ListadoTesis', compact('inscripciones','contador'));
    }

    public function editartesis($id)
    {
        $inscripciones = DB::table('inscripciones_tesis')->where('id', $id)->get();
        $profesores = DB::table('users')->where('tipo_usuario', 'profesor')->get();
        $directores = DB::table('users')->where('tipo_usuario', 'director')->get();

        return view ('Estudiantes.EditarTesis', compact('inscripciones','profesores','directores'));
    }

    public function guardarEdicionTesis(Request $request)
    {

        $id_inscripcion = $request->input('id');
        $id_alumno = Auth::user()->id;
        $date = Carbon::now();
        $date = $date->format('Y-m-d');


         DB::table('inscripciones_tesis')
            ->where('id', $id_inscripcion)
            ->update(array(

         'Nombre_tesis' => $request->input('NombreTesis'),
         'DescripcionTesis' => $request->input('DescripcionTesis'),
         'ObjetivosTema' =>  $request->input('ObjetivosTema'),
         'ContribucionEsperada' =>  $request->input('ContribucionEsperada'),
         'Alumno_id' => $id_alumno,
         'Director_id' => $request->input('director'),
         'Profesor_id' => $request->input('profesor'),
         'CodigoIncripcion' => "ICI-T ".uniqid(),
          'comision1' => "",
         'comision2' => "",
         'comision3' => "",
         'Semestre' => $request->input('semestre'),
         'FechaInscripcion' => $date,
          'Estado' => 'Pendiente-P',)
        );

         return redirect('/estudiante');
    }

     public function guardarinscripcionestesis(Request $request)
    {
        $inscripcion = new InscripcionesTesis;
        $id_alumno = Auth::user()->id;
        $date = Carbon::now();
        $date = $date->format('Y-m-d');


        DB::table('inscripciones_tesis')->insert([
         'Nombre_tesis' => $request->input('NombreTesis'),
         'DescripcionTesis' => $request->input('DescripcionTesis'),
         'ObjetivosTema' =>  $request->input('ObjetivosTema'),
         'ContribucionEsperada' =>  $request->input('ContribucionEsperada'),
         'Alumno_id' => $id_alumno,
         'Director_id' => $request->input('director'),
         'Profesor_id' => $request->input('profesor'),
         'CodigoIncripcion' => "ICI-T ".uniqid(),
         'comision1' => "",
         'comision2' => "",
         'comision3' => "",
         'Semestre' => $request->input('semestre'),
         'FechaInscripcion' => $date,
          'Estado' => 'Pendiente-P'

        ]);

       return redirect('/estudiante');
    }



}
