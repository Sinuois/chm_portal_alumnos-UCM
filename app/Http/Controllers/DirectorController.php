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
use Mail;
use App\Mail\MailMensaje;
Use Config;
use App\Destinatario;

class DirectorController extends Controller
{
   public function index()
    {


        $id_director = Auth::user()->id;
        $directors = User::where('id','=',$id_director)->get(); 


         $inscripciones = DB::table('inscripciones_tesis')->where('Director_id', $id_director)->get();

        return view('Director.index', compact('directors','inscripciones'));
    }

    public function formulario_correo()
    {
      Config::set('mail.host', 'smtp.gmail.com');
      Config::set('mail.username', 'portal.ucm.2019@gmail.com');
      Config::set('mail.password', 'ioyqjalfnikirwhg');
      Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
      Config::set('mail.from.name', 'UCM');
      Config::set('mail.encryption', 'tls');
      Config::set('mail.port', 587);

      Destinatario::truncate(); //Cada vez que se entre al formulario, se borran los destinatarios almacenados

      $busqueda = 'Estudiante';

      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      $destinatarios = Destinatario::All();
      return view('director.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function agregar_destinatario($nombre, $correo, $tipo_mail)
    {      
      $chequeo_existencia = Destinatario::where('correo', '=', $correo)->first(); //Ver si existe algún elemento repetido
      if ($chequeo_existencia === null) { //Si no hay ninguno repetido, crear nuevo
        $destinatario = new Destinatario;
        $destinatario->nombre = $nombre;
        $destinatario->correo = $correo;
        $destinatario->save();
      }

      if ($tipo_mail == 'gmail') {
        Config::set('mail.host', 'smtp.gmail.com');
        Config::set('mail.username', 'portal.ucm.2019@gmail.com');
        Config::set('mail.password', 'ioyqjalfnikirwhg');
        Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }

      if ($tipo_mail == 'hotmail') {
        Config::set('mail.host', 'smtp.office365.com'); 
        Config::set('mail.username', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.password', 'calidadsoftware19'); 
        Config::set('mail.from.address', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }

      $destinatarios = Destinatario::All();

      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      return view('director.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function borrar_destinatario($id) {
      $destinatario = \App\Destinatario::find($id);
      $destinatario->delete();
      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();

      Config::set('mail.host', 'smtp.gmail.com');
      Config::set('mail.username', 'portal.ucm.2019@gmail.com');
      Config::set('mail.password', 'ioyqjalfnikirwhg');
      Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
      Config::set('mail.from.name', 'UCM');
      Config::set('mail.encryption', 'tls');
      Config::set('mail.port', 587);

      $destinatarios = Destinatario::All();
      return view('director.formulario_correo', compact('alumnos', 'destinatarios'));
    }

    public function enviar_correo(Request $request)
    {
      $tipo_mail = $request->input('tipo_mail');

      if ($tipo_mail == 'gmail') {
        Config::set('mail.host', 'smtp.gmail.com');
        Config::set('mail.username', 'portal.ucm.2019@gmail.com');
        Config::set('mail.password', 'ioyqjalfnikirwhg');
        Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }
      if ($tipo_mail == 'hotmail') {
        Config::set('mail.host', 'smtp.office365.com'); 
        Config::set('mail.username', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.password', 'calidadsoftware19'); 
        Config::set('mail.from.address', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }      
      $destinatarios = Destinatario::pluck('correo'); //Obtener un arreglo de correos, sacados de la tabla de destinatarios
      $mensaje = $request->input('mensaje');
      $enviado_por = 'Enviado por director ';
      $nombres = Auth::user()->nombres;
      $apellidos =  Auth::user()->apellidos;
      $mensaje = $mensaje.$enviado_por.' '.$nombres.' '.$apellidos.'.';
      Mail::to($destinatarios)->send(new MailMensaje($mensaje));
      return redirect('/home');
    }

    public function cambiar_tipo_mail($tipo_mail)
    {
      if ($tipo_mail == 'hotmail') {
        Config::set('mail.host', 'smtp.gmail.com');
        Config::set('mail.username', 'portal.ucm.2019@gmail.com');
        Config::set('mail.password', 'ioyqjalfnikirwhg');
        Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }

      if ($tipo_mail == 'gmail') {
        Config::set('mail.host', 'smtp.office365.com'); 
        Config::set('mail.username', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.password', 'calidadsoftware19'); 
        Config::set('mail.from.address', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }

      $destinatarios = Destinatario::All();

      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      })->get();
      return view('director.formulario_correo', compact('alumnos', 'destinatarios'));
      
    }


    public function busqueda_estudiante_mail(Request $request)
    {
      $tipo_mail = $request->input('tipo_mail');
      $busqueda = $request->input('busqueda');

      if ($tipo_mail == 'hotmail') {
        Config::set('mail.host', 'smtp.office365.com'); 
        Config::set('mail.username', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.password', 'calidadsoftware19'); 
        Config::set('mail.from.address', 'portal.ucm.2019@hotmail.com'); 
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);

      }

      if ($tipo_mail == 'gmail') {
        Config::set('mail.host', 'smtp.gmail.com');
        Config::set('mail.username', 'portal.ucm.2019@gmail.com');
        Config::set('mail.password', 'ioyqjalfnikirwhg');
        Config::set('mail.from.address', 'portal.ucm.2019@gmail.com');
        Config::set('mail.from.name', 'UCM');
        Config::set('mail.encryption', 'tls');
        Config::set('mail.port', 587);
      }
     
      $destinatarios = Destinatario::All();

      $alumnos = DB::table('users')->where('tipo_usuario', 'estudiante')->whereNotIn('email',function($query) {
        $query->select('correo')->from('destinatarios_correo'); 
      }) 
      ->where(function($query2) use ($busqueda){
        $query2->where('apellidos', 'LIKE', '%'.$busqueda.'%')->orwhere('nombres', 'LIKE', '%'.$busqueda.'%'); 
      })
      ->get();
      return view('director.formulario_correo', compact('alumnos', 'destinatarios'));
      
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
