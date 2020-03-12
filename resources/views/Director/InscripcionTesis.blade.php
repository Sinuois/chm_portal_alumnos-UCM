@extends('layout.master')

@section('title')
  <title>Inscripcion de tesis</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')

<br>
<div class="container">
    <form class="col s12" action="{{url('/director/inscripcion/guardar')}}" method="post" >
      @csrf
      <h4 class="center-align black-text text-darken-2">Inscripcion de tesis</h4>

     @foreach ($inscripciones as $inscripcion)
     

          <input name="id" type="hidden" value='{{$inscripcion->id}}'  >



           @foreach ($alumnos as $alumno) 

           @if ($alumno->id == $inscripcion->Alumno_id)

            <div class="input-field col s12">
              <input name="alumno" value="{{$alumno->nombres." ".$alumno->apellidos}}" id="alumno" type="text" readonly >
              <label for="alumno">Alumno</label>
            </div>

           @endif

          @endforeach

           @foreach ($profesores as $profesor) 

           @if ($profesor->id == $inscripcion->Profesor_id)

          <div class="input-field col s12">
              <input name="profesor" value="{{$profesor->nombres." ".$profesor->apellidos}}" id="profesor" type="text" readonly >
              <label for="profesor">Profesor</label>
           </div>


                   @endif

          @endforeach


          @foreach ($directores as $director) 

           @if ($director->id == $inscripcion->Director_id)
      
              <div class="input-field col s12">
                  <input name="director" value="{{$director->nombres." ".$director->apellidos}}" id="director" type="text"readonly  >
                  <label for="director">Director</label>
                  
               </div>

                @endif

          @endforeach

            <div class="input-field col s12">
              <input name="NombreTesis" type="text" value='{{$inscripcion->Nombre_tesis}}' readonly >
              <label for="NombreTesis">Nombre de tesis</label>
        </div>


          <div class="input-field col s12">
              <input name="Comision1" value="{{$inscripcion->Comision1}}" id="Comision1" type="text"readonly  >
              <label for="Comision1">Comision1</label>
          </div>

          <div class="input-field col s12">
              <input name="Comision2" value="{{$inscripcion->Comision2}}" id="Comision2" type="text"readonly  >
              <label for="Comision2">Comision2</label>
          </div>

          <div class="input-field col s12">
              <input name="Comision3" value="{{$inscripcion->Comision3}}" id="Comision3" type="text"readonly  >
              <label for="Comision3">Comision3</label>
          </div>


        
          <div class="input-field col s12">
            <input value="{{$inscripcion->DescripcionTesis}}" name="DescripcionTesis" id="DescripcionTesis" type="text" readonly >
            <label for="DescripcionTesis">Descripcion de Tesis</label>
          </div>

          <div class="input-field col s12">
                <input value="{{$inscripcion->ObjetivosTema}}" name="ObjetivosTema" id="ObjetivosTema" type="text" readonly >
                <label for="ObjetivosTema">Objetivos</label>
         </div>

      
          <div class="input-field col s12">
                  <input value="{{$inscripcion->ContribucionEsperada}}" name="ContribucionEsperada" id="ContribucionEsperada" type="text" readonly >
                  <label for="ContribucionEsperada">Contrib. Esperada</label>

           </div>


      @endforeach

      


     
      

  


      <a class="waves-effect red darken-1 btn" href="http://localhost:8000/director" >Cancel</a>
      <button class="btn waves-effect waves-light" type="submit">Enviar</button>
    </form>
</div>
@endsection
        
@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection




