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
      <h4 class="title">Mi Solicitud para Botar Ramos</h4>
    </div>

    <div class="content centered">
        <table id="user_table" class="table table-striped centered">
          <thead class="centered ">
          <th>ID</th>
          <th>Código</th>
          <th>Curso</th>
          <th>Creditos</th>
          <th>Estado</th>
          <th>Eliminar</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($user->tomarbotarcursos()->orderBy('id','ASC')->get() as $tomarbotarcurso)
            <tr>
              <td>{{ $tomarbotarcurso->id }}</td>
              <td>{{ $tomarbotarcurso->curso->codigo }}</td>
              <td>{{ $tomarbotarcurso->curso->nombre }}</td>
              <td>{{ $tomarbotarcurso->curso->creditos }}</td>   
              <td>{{ $tomarbotarcurso->estado }}</td> 
              <td><a href="{{route('botacurso.destroy', $tomarbotarcurso->id)}}" onclick="M.toast({html: 'solicitud eliminada exitosamente', displayLenght: 4000})" class="btn btn red"> eliminar</a></td>
            </tr>      
          @endforeach
        </tbody>

       </table>

       <!-- MODAL-->
       <div class="container section">
         <a href="#idModal" class="btn modal-trigger"> Añadir curso</a>

         <div id="idModal" class="modal">          
           <div class="modal-content">
            <form action="{{ route('usuario.guarda3') }}" method="POST">
              @csrf

              <h5> Ingrese el curso</h5>
           
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
                  
                    <option value="error_al_tomar">Error al tomar</option>
                    <option value="motivos_personales">Motivos Personales</option>
                    <option value="falta_de_tiempo">Falta de Tiempo</option>
                  </select>
                </div>


                <button class="btn btn-info" onclick="M.toast({html: 'solicitud enviada exitosamente', displayLenght: 4000})" type="submit">Añadir</button>
             </form>
           </div>
         </div>

       </div>

</div>

  
@endsection


@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
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