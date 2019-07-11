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
    <form class="col s12" action="{{url('/profesor/inscripcion/guardar')}}" method="post" >
      @csrf
      <h5 class="center-align black-text text-darken-2">Inscripcion de tesis</h5>


     @foreach ($inscripciones as $inscripcion)


          <input name="id" type="hidden" value='{{$inscripcion->id}}'  >
    
   @endforeach 
          <input name="estado" type="hidden" value='Pendiente-D'  >

         @foreach ($profesor as $profesorr)

          <div class="input-field col s12">
              <input name="profesor" value="{{$profesorr->nombres." ".$profesorr->apellidos}}" id="profesor" type="text" readonly >
              <label for="profesor">Profesor</label>
           </div>

           @endforeach

        
              @foreach ($director as $directorr)
              <div class="input-field col s12">
                  <input name="director" value="{{$directorr->nombres." ".$directorr->apellidos}}" id="director" type="text"readonly  >
                  <label for="director">Director</label>
                  
               </div>

            @endforeach

                @foreach ($alumno as $alumnoo)
              <div class="input-field col s12">
                  <input name="alumno" value="{{$alumnoo->nombres." ".$alumnoo->apellidos}}" id="alumno" type="text"readonly  >
                  <label for="alumno">Alumno</label>
                  
               </div>

            @endforeach


                <div class="input-field col s12">
            <input value="{{$inscripcion->Semestre}}" name="semestre" id="semestre" type="text" readonly >
            <label for="semestre">Semestre</label>
         </div>

          <div class="input-field col s12">
              <input name="NombreTesis" type="text" value='{{$inscripcion->Nombre_tesis}}' readonly >
               <label for="NombreTesis">Nombre de tesis</label>
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

      


      <div >
          <div class="input-field col s12">
            <input name="comision1" id="comision1" type="text" class="validate" >
            <label for="comision1">1° comisionado</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <div >
          <div class="input-field col s12">
            <input name="comision2" id="comision2" type="text" class="validate" >
            <label for="comision2">2° comisionado</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <div>
          <div class="input-field col s12">
            <input name="comision3" id="comision3" type="text" class="validate" >
            <label for="comision3">3° comisionado</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

  


      <a class="waves-effect red darken-1 btn" href="http://localhost:8000/profesor" >Cancel</a>
      <button class="btn waves-effect waves-light" type="submit">Enviar</button>
    </form>
</div>
@endsection
        
@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection




