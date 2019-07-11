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


  <center>
    <h1>MI SOLICITUD PARA BOTAR RAMOS</h1>
    <div class="container">
      <center>
        <table id="user_table" class="table table-striped">
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

              <h3> Ingrese el curso</h3>
            
              
              <!-- SELECT-->
                <div class="input-field col s12">
                  <select name="nombre">
                    @foreach($cursos as $curso)
                      <option>{{$curso->nombre}}</option>
                    @endforeach
                  </select>
                </div>



                <button class="btn btn-info" onclick="M.toast({html: 'solicitud enviada exitosamente', displayLenght: 4000})" type="submit">Añadir</button>
             </form>
           </div>
         </div>

       </div>
      </center>
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