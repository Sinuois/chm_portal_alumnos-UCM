<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InscripcionesTesis;
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
}
