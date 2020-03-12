{{-- Mantenemos estandar base --}}
@extends('layout.master')

{{-- Cambiamos titulo de pagina --}}
@section('title')
  <title>Estudiante</title>
@endsection

{{-- Incluimos los archivos a utilizar para front --}}
@section('styles')
  @include('layout.materialize') {{-- De usar materialize, incluimos desde el layout --}}
@endsection

{{-- Aqui trabajamos todo el contenido de la vista --}}
@section('body')
  {{-- Contenido --}}
<div class="container section">
  <div class="card-panel center">
    <div class="header">
      <h4 class="title">Mi Solicitud de Toma de Ramos</h4>
    </div>

  <div>
    <div class="content center">
        <table id="user_table" class="table table-striped table-responsive table-hover centered ">
          <thead class="centered ">
        {{-- <table  class="table table-striped"> --}}
          <th>ID</th>
          <th>Código</th>
          <th>Curso</th>
          <th>Creditos</th>
          <th>Motivo</th>
          <th>Estado</th>
          <th>Eliminar</th>
          <th></th>
        </thead>
        <div class="center ">
          <tbody>
          @foreach($user->tomarcursos()->orderBy('id','ASC')->get() as $tomarcurso)
            <tr style="text-align: center">
              <td>{{ $tomarcurso->id }}</td>
              <td>{{ $tomarcurso->curso->codigo }}</td>
              <td>{{ $tomarcurso->curso->nombre }}</td>
              <td>{{ $tomarcurso->curso->creditos }}</td>  
              <td>{{ $tomarcurso->motivo}}
              <td>{{ $tomarcurso->estado }}</td> 
              
              <td style="text-align: center"><a href="{{route('tomacurso.destroy', $tomarcurso->id)}}" onclick="M.toast({html: 'solicitud eliminada exitosamente', displayLenght: 4000})" class="btn btn red"> eliminar</a></td>
            </tr>      
          @endforeach
        </tbody>

       </table>
    </div>

  </div>
       <!-- MODAL-->
       <div class="container section">
         <a href="#idModal" class="btn modal-trigger"> Añadir curso</a>

         <div id="idModal" class="modal">          
           <div class="modal-content">
            <form action="{{ route('usuario.guarda2') }}" method="POST">
              @csrf

              <div class="header">
                <h5 class="title">Ingrese Curso</h5>
              </div>
            
              <!-- SELECT-->
                <div class="input-field col s12">
                  <select name="nombre">
                    @foreach($cursos as $curso)
                      <option>{{$curso->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              <h5> Ingrese el motivo</h5>
                <div class="input-field col s12">
                  <select name="motivo"> 
                    <option> {{ $curso->motivo}}</option>
                  
                    <option value="sin_prerequisito">Sin Prerequisito</option>
                    <option value="con_prerequisito">Con Prerequisito</option>
                    <option value="no lo inscribi">No Inscripcion</option>
                    <option value="aumento de creditos">Aumento de Credito</option>
                  </select>
                </div>

                <button class="btn btn-info" onclick="M.toast({html: 'solicitud enviada exitosamente', displayLenght: 4000})" type="submit">Añadir</button>
             </form>
           </div>
         </div>

  </div>
</div>



  
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });

</script>

<script>
    document.addEventListener('h', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });

</script>

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection
