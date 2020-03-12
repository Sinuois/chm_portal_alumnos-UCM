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
    <div class="card center">
  <center>
    <h4>Asignaturas Carrera</h4>
    {{-- <div class="container"> --}}
      <center>
        <table id="user_table" class="table table-striped centered">
        <thead>
          <th></th>
        <th>ID</th>
          <th>Código</th>
          <th>Nombre</th>
          <th>Creditos</th>
          <th>Semestre</th>
          <th></th>
          <th>Editar</th>
          <th>Eliminar</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
         @foreach($muestracursos as $muestracurso)
            <tr>
              <td></td>
             <td>{{$muestracurso->id }}</td>
              <td>{{$muestracurso->codigo }}</td>
              <td>{{$muestracurso->nombre }}</td>
              <td>{{$muestracurso->creditos }}</td> 
              <td>{{$muestracurso->semestre}}</td> 
              <td></td>
              <td>  
                  <!-- MODAL EDITAR CURSO-->
                  <div class="container section">
                    <a href="#idModal{{$muestracurso->id}}" class="btn modal-trigger yellow"><ion-icon size = "large" name="create"></ion-icon></a>

                    <div id="idModal{{$muestracurso->id}}" class="modal">          
                      <div class="modal-content">
                        <form action="{{ route('director.editaRamo',$muestracurso->id) }}" method="POST">
                          {{csrf_field()}}
                          {{method_field('PUT')}}
                          <h3>FORMULARIO EDITAR CURSO</h3>
                            <h5>Nombre</h5>
                            <input type="text" id="nombre" name="nombre" value="{{$muestracurso->nombre}}">
                            <h5>Codigo</h5>
                            <input type="text" id="codigo" name="codigo" value="{{$muestracurso->codigo}}">
                            <h5>Creditos</h5>
                            <input type="text" id="creditos" name="creditos" value ="{{$muestracurso->creditos}}">
                            <h5>Semestre</h5>
                                <input type="text" id="semestre" name="semestre" value = "{{$muestracurso->semestre}}">
                            <button class="btn btn-info" onclick="M.toast({html: 'editado exitosamente', displayLenght: 4000})" type="submit">Editar</button>
                        </form>

                      </div>
                    </div>
              
                  
              
              </td>
              <td><a href="{{route('director.cursodestroy', $muestracurso->id)}}" onclick="M.toast({html: 'ramo eliminado exitosamente', displayLenght: 4000})" class="btn btn red"> <ion-icon size="large" name="trash"></ion-icon></a></td>
            </tr>      
          @endforeach
        </tbody>

       </table>

       <!-- MODAL-->
       <div class="container section">
         <a href="#idModal" class="btn modal-trigger"> Añadir curso</a>

         <div id="idModal" class="modal">          
           <div class="modal-content">
             <div class="container">
            <form action="{{ route('curso.guardado') }}" method="POST">
              @csrf
              <h4>Formulario Creación de Curso</h4>
              <h6>Nombre</h6>
              <input type="text" id="nombre" name="nombre" required>
              <h6>Codigo</h6>
              <input type="text" id="codigo" name="codigo" required>
              <h6>Creditos</h6>
              <input type="text" id="creditos" name="creditos" required>
              <h6>Semestre</h6>
              <input type="text" id="semestre" name="semestre" required>

                <button class="btn btn-info" onclick="M.toast({html: 'Ramo  Agregado exitosamente', displayLenght: 4000})" type="submit">Añadir</button>
             </form>
            </div>
           </div>
         </div>

       </div>
      </center>
</div>

<a href="{{route('toma.decisionToma2')}}" class="btn btn"> Menú pricipal</a>
  
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

<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection