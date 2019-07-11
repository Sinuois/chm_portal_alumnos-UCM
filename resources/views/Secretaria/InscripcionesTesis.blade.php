
@extends('layout.master')

@section('title')
  <title>Inscripcion de tesis</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                              
                              <div>
                                  <h4 class="title">Inscripciones de tesis aprobadas</h4>

                              </div>
                              <div>
                                     <h6>Buscar por rut de alumno</h6>

                                    <form action="/secretaria/InscripcionesTesisAprobadas/busqueda" method="POST" >
                                        {{ csrf_field() }}
                                        
                                            <input type="text" class="form-control" id="rut" name="rut"
                                                placeholder="Ingrese rut ej: 1.111.111-1"> <span class="input-group-btn">
                                                <button type="submit" class="btn waves-effect waves-light" style="background-color: #253e85;">Buscar</button>
                                            </span>

                                    </form>

                                  
                                      
                                  </div>
                            </div>
                            <div class="content">
                              <form>
                                  <div class="content table-responsive table-full-width">
                                      <table class="table table-hover table-striped">
                                          <thread>
                                          <th>Nombre tesis</th>
                                          <th>Profesor ID</th>
                                          <th>Alumno ID</th>
                                          <th>Fecha inscripcion</th>
                                          <th>Descargar Formulario de inscripcion</th>
                                          <th>Descargar Acta de inscripcion</th>
                                          </thread>
                                      <tbody>
                                      @foreach($inscripciones as $inscripcion) 
                                      <tr>
                                      @if( $inscripcion->Estado =='Aprobado' )
                                        <td>{{$inscripcion->Nombre_tesis}}</td>
                                        <td>{{$inscripcion->Profesor_id}}</td>
                                        <td>{{$inscripcion->Alumno_id}}</td>
                                        <td>{{$inscripcion->FechaInscripcion}}</td>
                                        <td>  <a href="{{ url("secretaria/imprimir_formulario/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Descargar</a> 
                                          </td>              
                                        <td>  <a href="{{ url("secretaria/imprimir_acta/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Descargar</a> 
                                      @endif
                                      </tr>
                                      @endforeach
                                      </tbody>
                                      </table>
                                 
                                  </div>
                                  <div class="clearfix"></div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <hr>


   


@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection

