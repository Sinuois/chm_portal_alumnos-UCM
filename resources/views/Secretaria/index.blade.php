{{-- Restriccion de acceso - Leer comentario en layout.redirect--}}
@include('layout.redirect')

@extends('layout.master')

@section('title')
  <title>Perfil Secretaria</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
  @foreach ($secretaries as $secretary) {{-- Obtención de los datos de la secretaria --}}
    @if ($secretary->id == Auth::user()->id) 

    <?php //se agrega este extracto en php para mostrar los puntos y guion del rut sin modificarlo en la base de datos.
    $rut_original = $secretary->rut; // se extrae el valor de la base de datos.
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
          <div class="card horizontal z-depth-1"> {{--Creacion de card superiro con datos de usuario--}}
              <div class="col s3 indigo" style="position: relative; top: 0px">
                  <h6 style = "color:white;"><b>Nombre:</b></h6>
                  <h6 style = "color:white;"><b>RUT:</b></h6>
                  <h6 style = "color:white;"><b>Email:</b></h6> 
                  <h6 style = "color:white;"><b>Teléfono:</b></h6>
                  <h6 style = "color:white;"><b>Celular:</b></h6>
              </div>
              <div class="col s9" style="position: relative; top: 0px"> 
                  <h6>&nbsp{{$secretary->nombres}}&nbsp{{$secretary->apellidos}}</h6> 
                  <h6>&nbsp{{$rut_modificado}}</h6>
                  <h6>&nbsp{{$secretary->email}}</h6>
                  <h6>&nbsp{{$secretary->telefono}}</h6>
                  <h6>&nbsp{{$secretary->celular}}</h6>
              </div>
              <div class="col s2">  
                  <div>    
                      @if (empty(Auth::user()->foto))  
                        <img src="/images/default.png" class="center-align" style="width:80%; position: relative; left: 47px; top: 2px">
                      @else
                        <img src="{{$secretary->foto}}" class="center-align" style="width:80%; position: relative; left: 47px; top: 2px">
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
                    &nbsp<b>Subir Documento</b></h6> </div>
                  <div class="collapsible-body">
                    <h5 class="title" align="center">Subir Documento</h5>
                    <br>
                      <form method="POST" action="{{route('subir')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="archivo"><b>Subir Archivo: </b></label><br>
                        <input type="file" name="archivo" required>
                        <button type="submit" class="btn waves-effect waves-light" style="background-color: #253e85;" >Subir Documento</button>
                      </form>
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
