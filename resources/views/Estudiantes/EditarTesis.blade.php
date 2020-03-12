@extends('layout.master')

@section('title')
  <title>Inscripcion de tesis</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
@if(session('errores'))
  <div class="card-panel teal accent-1">
    Inscripcion creada exitosamente
  </div>
@endif
<br>
<div class="container section">
  <div class="card-panel center">

    <form class="col s12" action="{{url('/estudiante/inscripciontesis/listado/guardar')}}" method="post" >
      @csrf
      <h4 class="center-align black-text text-darken-2">Inscripción de tesis</h4>

   
        @foreach($inscripciones as $inscripcion) 
        	 <input name="id" type="hidden" value='{{$inscripcion->id}}'  >
        @endforeach
      

     


      <div class="row">
             <select class="form-control" name="profesor">
              @foreach($profesores as $profesor)
                <option value="{{$profesor->id}}">{{$profesor->nombres." ".$profesor->apellidos}}</option>
              @endforeach
            </select>
      </div>
 
       <div class="row">
             <select class="form-control" name="director">
              @foreach($directores as $director)
                <option value="{{$director->id}}">{{$director->nombres." ".$director->apellidos}}</option>
              @endforeach
            </select>
      </div>

      <div class="row">
             <select class="form-control" name="semestre">
                <option value="1 Semestre">1° Semestre</option>
                <option value="2 Semestre">2° Semestre</option>
            </select>
      </div>

      <div >
          <div class="input-field col s12">
            <input name="NombreTesis" id="NombreTesis" type="text" class="validate" >
            <label for="NombreTesis">Nombre de tesis</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <div >
          <div class="input-field col s12">
            <input name="DescripcionTesis" id="DescripcionTesis" type="text" class="validate" >
            <label for="DescripcionTesis">Descripcion de Tesis</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <div>
          <div class="input-field col s12">
            <input name="ObjetivosTema" id="ObjetivosTema" type="text" class="validate" >
            <label for="ObjetivosTema">Objetivos</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <div >
          <div class="input-field col s12">
            <input name="ContribucionEsperada" id="ContribucionEsperada" type="text" class="validate" >
            <label for="ContribucionEsperada">Contrib. Esperada</label>
            <span class="helper-text" data-error="wrong" data-success="okey"></span>
      </div>

      <a class="waves-effect red darken-1 btn" href="http://localhost:8000/Estudiantes" >Cancel</a>
      <button class="btn waves-effect waves-light" type="submit">Enviar</button>
    </form>
</div>
</div>
@endsection
        
@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection


