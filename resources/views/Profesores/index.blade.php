<!--{{-- Restriccion de acceso - Leer comentario en layout.redirect--}}
@include('layout.redirect')

@extends('layout.master') -->

@section('title')
  <title>Perfil Profesor</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
  @foreach ($professors as $professor) {{-- Obtención de los datos del profesor --}}
    @if ($professor->id == Auth::user()->id) 

    <?php //se agrega este extracto en php para mostrar los puntos y guion del rut sin modificarlo en la base de datos.
    $rut_original = $professor->rut; // se extrae el valor de la base de datos.
    if (strlen($rut_original) == 7) { //O sea que, contando verificador, serían 8 dígitos
        $suma = $rut_original[6]*2+$rut_original[5]*3+$rut_original[4]*4+$rut_original[3]*5+$rut_original[2]*6+$rut_original[1]*7+$rut_original[0]*2;
      }
    if (strlen($rut_original) == 8) { //O sea que, contando verificador, serían 9 dígitos
      $suma = $rut_original[7]*2+$rut_original[6]*3+$rut_original[5]*4+$rut_original[4]*5+$rut_original[3]*6+$rut_original[2]*7+$rut_original[1]*2+$rut_original[0]*3;
    }
    $final = 11 - ($suma%11);
    
    $verificador = $final;
    if ($final == 11) {
      $verificador = 0;
    }
    if ($final == 10) {
      $verificador = "K";
    }
    
    $rut_con_verif = $rut_original.$verificador;
    
    if (strlen($rut_con_verif) == 8) { //si el largo del rut es de 8 números debería verse como 1.234.567-8
      $posicion = 1; //variable definida para indicar la posicion de algun caracter del rut
    }
    if (strlen($rut_con_verif) == 9) { //largo del rut es 9, implica 12.345.678-9
      $posicion = 2; //se inicia la posicion en 2 para agregar el punto entre el "2" y el "3"
    } //la funcion substr_replace se usa para agregar caracteres entre medio de otros.
    $rut_modificado = substr_replace($rut_con_verif, ".", $posicion, 0); //se necesita el string, caracter a agregar, posicion y 0.
    $rut_modificado = substr_replace($rut_modificado, ".", $posicion+4, 0); //es +4 porque cueta el caracter agergado antes.
    $rut_modificado = substr_replace($rut_modificado, "-", $posicion+8, 0);

    ?>

    <div class="row">
      <div class="col s12"> 
          <h5 class="left-align"><i class="material-icons">person</i><b>&nbspDatos Personales</b></h5>    
          <div class="card horizontal z-depth-1"> {{--Creacion de card superior con datos de usuario--}}
              <div class="col s3 indigo" style="position: relative; top: 0px">
                  <h6 style = "color:white;"><b>Nombre:</b></h6>
                  <h6 style = "color:white;"><b>RUT:</b></h6>
                  <h6 style = "color:white;"><b>Email:</b></h6>
                  <h6 style = "color:white;"><b>Cargo:</b></h6>
                  <h6 style = "color:white;"><b>Teléfono:</b></h6>
                  <h6 style = "color:white;"><b>Celular:</b></h6>
              </div>
              <div class="col s9" style="position: relative; top: 0px"> 
                  <h6>&nbsp{{$professor->nombres}}&nbsp{{$professor->apellidos}}</h6> 
                  <h6>&nbsp{{$rut_modificado}}</h6>
                  <h6>&nbsp{{$professor->email}}</h6>
                  <h6>&nbsp{{$professor->cargo}}</h6>
                  <h6>&nbsp{{$professor->telefono}}</h6>
                  <h6>&nbsp{{$professor->celular}}</h6>
              </div>
              <div class="col s2">  
                  <div>    
                      @if (empty(Auth::user()->foto))  
                        <img src="/images/default.png" class="center-align" style="width:85%; position: relative; left: 29px; top: 10px">
                      @else
                        <img src="{{$professor->foto}}" class="center-align" style="width:85%; position: relative; left: 29px; top: 10px">
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
              <h5 class="left-align"><b>&nbspInformación</b></h5>
              <ul class="collapsible"> <!--Collapsible de información-->
                <li>
                  <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                    &nbsp<b>Reservas Canceladas</b></h6> </div>
                  <div class="collapsible-body">
                    <form>
                      <div class="content table-responsive table-full-width">
                          <table class="table table-hover table-striped">
                              <thread>
                              <th>ID sala</th>
                              <th>Nombre sala</th>
                              <th>Bloque</th>
                              <th>Dia</th>
                              <th>Comentario</th>
                              <th></th>
                              </thread>
                          <tbody>
                          @if( $i != 0)
                          @foreach($reserva as $reser) <!--recorre todos los registros encontrados y los muestra en la vista-->
                          <tr>
                            @if( $reser->id_user == Auth::user()->id)
                              <td>{{$reser->id}}</td>
                              <td>{{$reser->nombre}}</td>
                              <td>{{$reser->bloque}}</td>
                              @if( $reser->dia_semana == 1)
                              <td>Lunes</td>
                              @endif
                              @if( $reser->dia_semana == 2)
                              <td>Martes</td>
                              @endif
                              @if( $reser->dia_semana == 3)
                              <td>Miercoles</td>
                              @endif
                              @if( $reser->dia_semana == 4)
                              <td>Jueves</td>
                              @endif
                              @if( $reser->dia_semana == 5)
                              <td>Viernes</td>
                              @endif
                              <td>{{$reser->comentario}}</td>
                            @endif

                            <td> <a  href="{{route('profesor_comentario.destroy', $reser->id)}}" class="waves-effect red darken-1 btn-small"><i class="pe-7s-trash">X</i></a></td>
                          </tr>
                          @endforeach
                          @endif
                          </tbody>
                          </table>
                      </div>
                      <div class="clearfix"></div>
                  </form>
                  </div>
                </li>
              </ul>
  
              <ul class="collapsible"> <!--Collapsible de información-->
                <li>
                  <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                    &nbsp<b>Revisión tesis</b></h6> </div>
                  <div class="collapsible-body">
                    <span>
                      <div class="section">
                        <table class="table-border table-striped responsive-table">
                          <thead>
                            <tr>
                              <th>Codigo Inscripcion</th>
                              <th>Semestre</th>
                              <th>Fecha Publicacion</th>
                              <th>revisar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <thead>
                              @foreach ($inscripciones as $inscripcion)
                              @if ($inscripcion->Estado=='Pendiente-P' )
                                  <tr>
                                    <td>{{$inscripcion->CodigoIncripcion}} </td>
                                    <td>{{$inscripcion->Semestre}} </td>
                                    <td>{{$inscripcion->FechaInscripcion}} </td>
                                    <td>
                                      <a href="{{ url("/profesor/inscripciontesis/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">revisar</a>
                                  </td>
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
