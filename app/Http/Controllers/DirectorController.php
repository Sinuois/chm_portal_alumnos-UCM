<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InscripcionesTesis;
use App\TomarCurso;
use App\TomaBotaCurso;
use App\Curso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DirectorController extends Controller
{
   public function index()
    {


        $id_director = Auth::user()->id;
        $directors = User::where('id','=',$id_director)->get(); 


         $inscripciones = DB::table('inscripciones_tesis')->where('Director_id', $id_director)->get();

        return view('Director.index', compact('directors','inscripciones'));
    }


    public function inscripcionestesis($id)
    {

       $inscripciones = new InscripcionesTesis;
       $profesor = new User;
       $alumnos = new User;
       $directores = new User;

       $id_d = Auth::user()->id;


        $profesores = DB::table('users')->where('tipo_usuario', 'profesor')->get();
        $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->get();
        $directores = DB::table('users')->where('id', $id_d)->get();
      // dd($inscripcion);

        $inscripciones = DB::table('inscripciones_tesis')->where('id', $id)->get();
    //  dd($inscripciones);
        return view ('Director.InscripcionTesis', compact('inscripciones','profesores','alumnos','directores'));
    }



     public function guardarinscripcionestesis(Request $request)
    {
        $inscripcion = new InscripcionesTesis;
        $id_inscripcion = $request->input('id');



      //  dd($request);

        DB::table('inscripciones_tesis')
            ->where('id', $id_inscripcion)
            ->update(array('Estado' => 'Aprobado')
        );

       return redirect('/director');
    }

        public function listadotesis()
    {
       $inscripciones = new InscripcionesTesis;
        $id = Auth::user()->id;

          $inscripciones = DB::table('inscripciones_tesis')->where('Director_id', $id)->paginate(6);
      // dd($inscripcion);
        return view ('Director.Detalles', compact('inscripciones'));

    }
    public function tomaIndex()
    {
        $muestracursos = TomarCurso::All();
        return view('Director.Solicitud')->with('muestracursos',$muestracursos);
    }

    public function tomaEdit(Request $request,$id)
    {
        $muestracursos = TomarCurso::find($id);
        $muestracursos->estado = $request->estado;
        $muestracursos->save();
        return redirect()->route('director.toma');
    }

    public function botaIndex()
    {
        $muestracursos = TomaBotaCurso::All();
        return view('Director.Bota')->with('muestracursos',$muestracursos);
    }

    public function botaEdit(Request $request, $id)
    {
        $muestracursos = TomaBotaCurso::find($id);
        $muestracursos->estado = $request->estado;
        $muestracursos->save();
        return redirect()->route('director.bota');
    }

    public function solicitudGrafico()
    {
        $solicitudes=[
            'pendientes' => TomarCurso::where('estado','pendiente')->count(),
            'aceptados' => TomarCurso::where('estado','aceptado')->count(),
            'rechazados' => TomarCurso::where('estado','rechazado')->count()
        ];
        return view('Director.principal2',$solicitudes);
    }
 //funciones nuevas
    public function ramoIndex()
    {
        $muestracursos = Curso::all();
        return view('Director.curso')->with('muestracursos',$muestracursos);
    }
    public function ramoDestroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->route('director.cursos');
    }
    public function modal(Request $request){
        
        //funcion para que no se agreguen dos cursos iguales
        $cursosExistentes = Curso::All();

        foreach($cursosExistentes as $cursosExistente){
            
            if($cursosExistente->nombre == $request->nombre){
                // no se puede agregar el curso
                
                return redirect()->route('director.cursos');
            }
            if($cursosExistente->codigo == $request->codigo){
                // no se puede agregar el curso
                return redirect()->route('director.cursos'); 
            }


        }
        $curso = new Curso();
        $curso->codigo = $request->codigo;
        $curso->nombre = $request->nombre;
        $curso->creditos = $request->creditos;
        $curso->semestre = $request->semestre;
        $curso->save();
        return redirect()->route('director.cursos');
    } 

    //función para editar la creación del curso
    public function ramoEditar(Request $request, $id ){
        $curso = Curso::find($id);
        $cursosExistentes = Curso::All();
        foreach($cursosExistentes as $cursosExistente){
            if($cursosExistente->nombre == $request->nombre){
                return redirect()->route('director.cursos');
            }
    
            if($cursosExistente->codigo == $request->codigo){
                return redirect()->route('director.cursos');
            }
        }

        $curso->codigo = $request->codigo;
        $curso->nombre = $request->nombre;
        $curso->creditos = $request->creditos;
        $curso->semestre = $request->semestre;
        $curso->save();
        return redirect()->route('director.cursos');
    }

}
