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
    <h4>Solicitudes de Toma de Ramos</h4>
    <div class="container">
      <center>
        <table id="user_table" class="table table-striped centered">
        <center>
          <th>ID</th>
          <th class="center">Alumno</th>
          <th  class="center">Código</th>
          <th  class="center">Curso</th>
          <th  class="center">Creditos</th>
          <th  class="center">Motivo</th>
          <th  class="center">Estado</th>
          <th  class="center">Editar</th>
          </center>
        </thead>
        <tbody>
          @foreach($muestracursos as $muestracurso)
            <center>
            <tr>
              <td  class="center">{{$muestracurso->id }}</td>
              <td  class="center">{{$muestracurso->user->nombres}}</td>
              <td  class="center">{{$muestracurso->curso->codigo }}</td>
              <td  class="center">{{$muestracurso->curso->nombre }}</td>
              <td  class="center">{{$muestracurso->curso->creditos }}</td> 
              <td  class="center">{{$muestracurso->motivo}}</td> 
              <td  class="center">{{$muestracurso->estado }}</td> 
              <td  class="center">
                  <!-- MODAL-->
                  <div class="container section">
                    <a href="#idModal{{$muestracurso->id}}" class="btn modal-trigger yellow"><ion-icon size="large" name="create"></a>

                   <div id="idModal{{$muestracurso->id}}" class="modal">          
                    <div class="modal-content">
                      
                      <form action="{{ route('director.edita',$muestracurso->id) }}" method="POST">
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
            </center>    
          @endforeach
        </tbody>

       </table>

      </center>
</div>

<br>

<a href="{{route('toma.decisionToma2')}}" class="btn btn"> Menú pricipal</a>
@endsection

@section('scripts')

<script src={{ asset('js/nav_scripts.js') }}></script>

<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

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