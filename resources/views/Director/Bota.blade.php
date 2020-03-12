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

<div class="container">
  <div class="card-panel center">
  <center>
    <h4>Solicitudes para Botar Ramos</h4>
    <div class="container">
      <center>
        <table id="user_table" class="table table-striped centered">
          <th>ID</th>
          <th>Alumno</th>
          <th>Código</th>
          <th>Curso</th>
          <th>Creditos</th>

          <th>Estado</th>
          <th>Editar</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($muestracursos as $muestracurso)
            <tr>
              <td>{{$muestracurso->id }}</td>
              <td>{{$muestracurso->user->nombres}}</td>
              <td>{{$muestracurso->curso->codigo }}</td>
              <td>{{$muestracurso->curso->nombre }}</td>
              <td>{{$muestracurso->curso->creditos }}</td>   

              <td>{{$muestracurso->estado }}</td> 
              <td>
                  <!-- MODAL-->
                  <div class="container section">
                    <a href="#idModal{{$muestracurso->id}}" class="btn modal-trigger yellow"><ion-icon size="large" name="create"></ion-icon></a>

                   <div id="idModal{{$muestracurso->id}}" class="modal">          
                    <div class="modal-content">
                      
                      <form action="{{ route('director.botaedita',$muestracurso->id) }}" method="POST">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <h3>EDITAR ESTADO</h3>

                          <div class="input-field col s12">
                            <select name="estado" required>
                              <option value="" disabled selected>elegir opcion</option>
                              <option value="aceptado">aceptado</option>
                              <option value="rechazado">rechazado</option>
                            </select>
                          </div>
                        <button class="btn btn-info" onclick="M.toast({html: 'estado editado exitosamente', displayLenght: 4000})" type="submit">Editar</button>
                      </form>

                    </div>
                  </div>

                </div>
              </td> 

            </tr>      
          @endforeach
        </tbody>

       </table>

      </center>
</div>
<br>
<a href="{{route('toma.decisionToma2')}}" class="btn btn"> Menú pricipal</a>
  
@endsection

@section('script')
  <script src={{ asset('js/nav_scripts.js') }}></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {


    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);


  });

    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });

</script>

<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>