<!--{{-- Restriccion de acceso - Leer comentario en layout.redirect--}}
@include('layout.redirect')

@extends('layout.master') -->

@section('title')
  <title>Perfil Director de Carrera</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
  @foreach ($directors as $director) {{-- Obtención de los datos del Director de Carrera --}}
    @if ($director->id == Auth::user()->id) 

      <div class="row">
        <div class="col s12"> 
            <h5 class="left-align"><i class="material-icons">person</i><b>&nbspDatos Personales</b></h5>    
            <div class="card horizontal z-depth-1"> {{--Creacion de card superiro con datos de usuario--}}
                <div class="col s3 indigo" style="position: relative; top: 0px">
                    <h6 style = "color:white;"><b>Nombre:</b></h6>
                    <h6 style = "color:white;"><b>RUT:</b></h6>
                    <h6 style = "color:white;"><b>Email:</b></h6>
                    <h6 style = "color:white;"><b>Teléfono:</b></h6>
                    <h6 style = "color:white;"><b>Celular:</b></h6>
                </div>
                <div class="col s9" style="position: relative; top: 0px"> 
                    <h6>&nbsp{{$director->nombres}}&nbsp{{$director->apellidos}}</h6> 
                    <h6>&nbsp{{$director->rut}}</h6>
                    <h6>&nbsp{{$director->email}}</h6>
                    <h6>&nbsp{{$director->telefono}}</h6>
                    <h6>&nbsp{{$director->celular}}</h6>
                </div>
                <div class="col s2">  
                    <div>    
                        @if (empty(Auth::user()->foto))  
                          <img src="/images/default.png" class="center-align" style="width:80%; position: relative; left: 47px; top: 2px">
                        @else
                          <img src="{{$director->foto}}" class="center-align" style="width:80%; position: relative; left: 47px; top: 2px">
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>      


        <div class="row">
          <div class="col s6">     
            <div class="card-panel z-depth-1"> <!--Rectangulito donde estará el título y el botón desplegable -->
              <h5 class="left-align"><b>Título de Ejemplo</b></h5> 
              </div>
          </div>      

          <div class="col s6">            
              <div class="card-panel z-depth-1"> <!--Rectangulito donde estará el título y el botón desplegable -->
                <h5 class="left-align"><b>&nbspInformación nº2</b></h5>
                <ul class="collapsible"> <!--Collapsible de información-->
                  <li>
                    <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                      &nbsp<b>Revision de tesis</b></h6> </div>
                    <div class="collapsible-body">
                      <span>
                        <div class="section">
                      <table class="table-border table-striped responsive-table">
                        <thead>
                          <tr>
                            <th>Codigo Inscripcion</th>
                            <th>Nombre de Tesis</th>
                            <th>Fecha Publicacion</th>
                            <th>revisar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <thead>
                                 @foreach ($inscripciones as $inscripcion)
                                   @if ($inscripcion->Estado=='Pendiente-D' )
                                    <tr>
                                      <td>{{$inscripcion->CodigoIncripcion}} </td>
                                      <td>{{$inscripcion->Nombre_tesis}} </td>
                                      <td>{{$inscripcion->FechaInscripcion}} </td>
                                      <td>
                                            <a href="{{ url("/director/inscripciontesis/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">revisar</a>
                                      </td>
                                    </tr>
                                    @endif
                                  @endforeach
                                     
                                </thead>
                              </tbody>
                            </table>
                        </div>
                      </span>
                    </div>
                  </li>
                </ul>
    
                <ul class="collapsible"> <!--Collapsible de información-->
                  <li>
                    <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                      &nbsp<b>Información Y</b></h6> </div>
                    <div class="collapsible-body">
                      <span>
                        <div class="section">
                          <h7><b>Ejemplo título</b></h7>
                          <p><i>&nbsp&nbspInformación respectiva al ejemplo.</i></p>
                        </div> 
                      </span>
                    </div>
                  </li>
                </ul>
              </div>
          </div>      
      </div>
    @endif
  @endforeach
@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection
