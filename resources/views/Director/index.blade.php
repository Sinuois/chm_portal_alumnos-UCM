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
        <div class="col s4">     
            <div class="card-panel z-depth-5"> <!--Rectangulito donde estará el título y el botón desplegable -->
              <?php $direccion_imagen = Auth::user()->foto ?>
              <div align="center">    
                @if (empty(Auth::user()->foto))  
                  <img src="/images/default.png") style="width:40%">
                @else
                  <img src="{{$director->foto}}") style="width:40%">
                @endif
              </div>
              <h4><i class="material-icons">person</i>&nbsp{{$director->nombres}}&nbsp{{$director->apellidos}}</h4> 
              
              <div class="divider"></div>
              <div class="section">
                <h5><b>RUT</b></h5>
                <p><b><i>&nbsp&nbsp{{$director->rut}}</i></b></p>
              </div>
            </div>
        </div>      
        <div class="col s8">            
            <div class="card-panel z-depth-5"> <!--Rectángulo donde estará el título y el botón desplegable -->
              <h4>Bienvenido, Director de Carrera</h4>  
            </div>
            <ul class="collapsible"> <!--Collapsible de información-->
            <li>
              <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                &nbsp<b>Información Personal</b></h6> </div>
              <div class="collapsible-body">
                <span>
                  <div class="section">
                    <h7><b>Email</b></h7>
                    <p><i>&nbsp&nbsp{{$director->email}}</i></p>
                  </div> 
                </span>
              </div>
              <div class="collapsible-body">
                <span>
                    <div class="section">
                      <h7><b>Dirección</b></h7>
                      <p><i>&nbsp&nbsp{{$director->direccion_actual}}</i></p>
                    </div> 
                  </span>
              </div>
              <div class="collapsible-body">
                <span>
                  <div class="section">
                    <h7><b>Teléfono</b></h7>
                    <p><i>&nbsp&nbsp{{$director->telefono}}</i></p>
                  </div> 
                </span>
              </div>
              <div class="collapsible-body">
                <span>
                  <div class="section">
                    <h7><b>Celular</b></h7>
                    <p><i>&nbsp&nbsp{{$director->celular}}</i></p>
                  </div> 
                </span>
              </div>
            </li>
          </ul>

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
        </div>      
      </div>
    @endif
  @endforeach
@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection
