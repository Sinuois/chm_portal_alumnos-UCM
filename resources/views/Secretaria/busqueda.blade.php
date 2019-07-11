@extends('layout.master')

@section('title')
  <title>Listado Reservas</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')


<div class="container">
    @if(isset($details))
        <p> Los resultados para <b> {{ $query }} </b> son :</p>
     <table class="table table-hover table-striped">
                                          <thread>
                                          <th>Nombre tesis</th>
                                          <th>Profesor ID</th>
                                          <th>Alumno ID</th>
                                          <th>Fecha inscripcion</th>
                                          <th>Descargar formulario de inscripcion</th>
                                          <th>Descargar acta de inscripcion</th>
                                          </thread>
                                      <tbody>
                                      @foreach($details as $inscripcion_) 
                                      <tr>
                                      @if( $inscripcion_->Estado =='Aprobado' )
                                        <td>{{$inscripcion_->Nombre_tesis}}</td>
                                        <td>{{$inscripcion_->Profesor_id}}</td>
                                        <td>{{$inscripcion_->Alumno_id}}</td>
                                        <td>{{$inscripcion_->FechaInscripcion}}</td>
                                        <td>  <a href="{{ url("secretaria/imprimir_formulario/{$inscripcion_->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Descargar</a></td>
              
                                        <td>  <a href="{{ url("secretaria/imprimir_acta/{$inscripcion_->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Descargar</a></td>
                                      @endif
                                      </tr>
                                      @endforeach
                                      </tbody>
                                      </table>
    @else

              <p> No existen resultados para esta busqueda, ingrese otro rut.</p>

    @endif
</div>



@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection






 





         
       