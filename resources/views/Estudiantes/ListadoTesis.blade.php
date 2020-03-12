@extends('layout.master')

@section('title')
  <title>Inscripcion de tesis</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@if($contador=='0')

@endif

@section('body')


    @if($contador=='0')

          <div class="content">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="header">
                                      <h4 class="title">Inscripciones de tesis aprobadas</h4>
                                      <br>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
          </div>
          <br>
          <div> <h8>No hay tesis inscritas</h8></div>

    @endif

    @if($contador!='0')
    <div class="container section">
            <div class="card-panel center">
                <div class="row">
                    <div class="col-md-12">
                            <div class="header">
                                <h4 class="title">Inscripciones de tesis aprobadas</h4>
                            </div>
                            <div class="content">
                              <form>
                                  <div class="content table-responsive table-full-width">
                                      <table class="table table-hover table-striped">
                                          <thread>
                                          <th>Nombre tesis</th>
                                          <th>Profesor ID</th>
                                          <th>Fecha inscripcion</th>
                                          <th>Editar</th>
                                          </thread>
                                      <tbody>
                                      @foreach($inscripciones as $inscripcion) 
                                      <tr>
                                      @if( $inscripcion->Estado =='Pendiente-P' || $inscripcion->Estado =='Pendiente-D' )
                                        <td>{{$inscripcion->Nombre_tesis}}</td>
                                        <td>{{$inscripcion->Profesor_id}}</td>
                                        <td>{{$inscripcion->FechaInscripcion}}</td>
                                         <td>  <a href="{{ url("/estudiante/inscripciontesis/listado/editar/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Editar</a></td>

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
     @endif

@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection










         
       