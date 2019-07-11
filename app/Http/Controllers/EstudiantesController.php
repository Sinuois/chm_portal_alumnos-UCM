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
use App\Pregunta;
use App\Respuesta;
use App\Comentario;
use App\EnCursoPractica;
use Carbon\Carbon;
use DateTime;
use App\Curso;
use App\TomarCurso;
use App\TomaBotaCurso;

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
        $datos->inspeccionado = new DateTime();

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
        $Practicas = Practicasprofesionale:: where('Estado', '=', 'Aprobado')
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

    public function evaluacionpractica(Request $request)
    {
        $Entrevista = Pregunta::where('TipoPregunta','Practicante')->
                                orderBy('id', 'asc')->
                                get();
        return view ('Estudiantes.EvaluacionAlumnoEmpresa' , compact('Entrevista'));
    }


    public function evaluacionpracticaenvio(Request $request)
    {
        $MatrizEncuesta = $request->Encuesta;

        $CambioInspeccion = PostulacionesPractica::where('alumnoid',Auth::user()->id)->
                                                    where('estado','Aceptada')->
                                                    orWhere('Estado', '=', 'Confirmada')->
                                                    first();
        $CambioInspeccion->inspeccionado = new DateTime();
        $CambioInspeccion->timestamps = false;
        $CambioInspeccion->save();

        $FinalEncuesta = EnCursoPractica::  where('alumnoid',Auth::user()->id)->
                                            where('estado','Finalizada')->
                                            orWhere('estado','FinalizadaRespondidaE')->
                                            first();
        if($FinalEncuesta->estado == "Finalizada"){
            $FinalEncuesta->estado = "FinalizadaRespondidaA";
        }
        if($FinalEncuesta->estado == "FinalizadaRespondidaE"){
            $FinalEncuesta->estado = "Concluida";
        }
        $FinalEncuesta->save();

        foreach ($MatrizEncuesta as $ArrayEncuesta) {
            foreach ($ArrayEncuesta as $Opcion) {
                $IndexMatrix = explode(',', $Opcion);
                $IndexArrayY = $IndexMatrix[0];
                $IndexArrayX = key($ArrayEncuesta);


                $IngresoBDRespuesta = new Respuesta;
                $IngresoBDRespuesta->alumnoid = Auth::user()->id;
                $IngresoBDRespuesta->preguntaid = $IndexArrayY;
                $IngresoBDRespuesta->postulacionid = $FinalEncuesta->id;
                $IngresoBDRespuesta->NivelDeConformidad = $IndexArrayX;
                $IngresoBDRespuesta->save();
            }
        }
        $IngresoBDComentario = new Comentario;
        $IngresoBDComentario->alumnoid = Auth::user()->id;
        $IngresoBDComentario->postulacionid = $FinalEncuesta->postulacionid;
        $IngresoBDComentario->comentario = $request->Comentario;
        $IngresoBDComentario->save();

        return redirect(route('estudiante'));
    }

    public function novedadespractica(Request $request)
    {
        $estudiante=Auth::user();
        $Notificaciones = PostulacionesPractica::   where('alumnoid','=',$estudiante->id)->
                                                    whereColumn('inspeccionado','<','updated_at')->
                                                    get();
        $Registros = PostulacionesPractica::where('alumnoid','=',$estudiante->id)->
                                            whereColumn('inspeccionado','>=','updated_at')->
                                            get();
        return view ('Estudiantes.NovedadesPractica' , compact('Notificaciones','Registros'));
    }
    public function VistoPractica(Request $request)
    {
        $ValorId = $request->tag;
        $fecha = Carbon::now();
        $VistoPostulacion = PostulacionesPractica::where('id',$ValorId)->first();
        $VistoPostulacion->timestamps = false;
        $VistoPostulacion->inspeccionado = $fecha;
        $VistoPostulacion->save();
        return "ok";
    }

    public function tomacurso()
    {
        $cursos = Curso::All();
        $user = User::find(Auth::User()->id);
        return view('Estudiantes.Solicitud')->with('user',$user)->with('cursos',$cursos);
    }

    public function crea_toma_curso()
    {
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();
        return view('Estudiantes.create')->with('user',$user)->with('cursos',$cursos);
    }

//FUNCION QUE GUARDA EL CURSO SELECCIONADO
    public function modal(Request $request){
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();

        
        //toma el nombre del curso y lo asocia a su codigo 
        foreach($cursos as $curso){
            if($request->nombre == $curso->nombre ){
                $laid= $curso->id;
            }
        }
        $tomacursos=TomarCurso::All();
        foreach($tomacursos as $tomacurso){
            if($tomacurso->user_id == $user->id){
                if($tomacurso->curso_id == $laid){
                    return redirect()->route('usuario.toma');           
                }
            }
        }
        $tomacurso = new TomarCurso();
        $tomacurso->user_id = $user->id;
        $tomacurso->curso_id = $laid;
        $tomacurso->motivo = $request->motivo;
        $tomacurso->save();
        return redirect()->route('usuario.toma');
    }   

    public function eliminarToma($id)
    {
        $tomacurso = TomarCurso::find($id);
        $tomacurso->delete();
        return redirect()->route('usuario.toma');
    }

    public function botacurso()
    {
        $cursos = Curso::All();
        $user = User::find(Auth::User()->id);
        return view('Estudiantes.Bota')->with('user',$user)->with('cursos',$cursos);
    }

    public function eliminarBota($id)
    {
        $tomacurso = TomaBotaCurso::find($id);
        $tomacurso->delete();
        return redirect()->route('usuario.bota');
    }

    public function modal2(Request $request){
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();
        
        //toma el nombre del curso y lo asocia a su codigo 
        foreach($cursos as $curso){
            if($request->nombre == $curso->nombre){
                $laid= $curso->id;
            }
        }

        $tomacursos=TomaBotaCurso::All();
        foreach($tomacursos as $tomacurso){
            if($tomacurso->user_id == $user->id){
                if($tomacurso->curso_id == $laid){
                    return redirect()->route('usuario.bota');           
                }
            }
        }
        $tomacurso = new TomaBotaCurso();
        $tomacurso->user_id = $user->id;
        $tomacurso->curso_id = $laid;
        $tomacurso->save();
        return redirect()->route('usuario.bota');
    } 

}
