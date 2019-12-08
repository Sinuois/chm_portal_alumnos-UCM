@if(Auth::check())
  {{-- Para los index se puede utilizar este modo de redireccionar por rol,
       pero para los sub directorios de cada rol, se puede agregar este mismo codigo
       pero se debe reemplazar el $uri por el rol correspondiente, EJ: 'estudiante' --}}
  @php
  @endphp
  @if(Auth::user()->tipo_usuario != "secretaria")
    @php
      header("Location: /home");
      die();
    @endphp
  @endif
@else
  @php
    header("Location: /home");
    die();
  @endphp
@endif 

@extends('layout.master')

@section('title')
  <title>Envío de correos</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
<div class='row justify-content-center'>
        <div class='row'>
          <div class="col s12 ">
            <div class='card-panel white'>   
              <p>                   
                <h3 class='center-align'>Seleccionar alumnos para envío de correo</h3>
                <?php $chequear_correo = config('mail.host') ?>
                @if ($chequear_correo == 'smtp.office365.com')
                  Enviar desde correo: Hotmail
                  <?php $tipo_mail = 'hotmail' ?>
                @else
                  @if ($chequear_correo == 'smtp.gmail.com')
                    Enviar desde correo: Gmail
                    <?php $tipo_mail = 'gmail' ?>
                  @endif
                @endif
                <a class='btn-floating waves-effect blue darken-4' style="position: relative; left: 10px" href='/secretaria/cambiar_a/{{$tipo_mail}}' role="button">
                  <i class='material-icons'>loop</i>
                </a> 

                <form method="get" action="{{ url('/secretaria/busqueda_estudiante_mail') }}">
                  <div class="input-field col s2">
                      <input id="busqueda" name="busqueda" placeholder="Ingresar búsqueda" style="search">
                  </div>
                  <input id="tipo_mail" type="hidden" name ="tipo_mail" value="{{$tipo_mail}}" >
                  <br><br><br>
                  <button style="position: relative; top: 10px; right: 260px" class="btn waves-effect waves-light" type="submit">Buscar</button>      
              </form>
              <br><br>

                <h4>Alumnos seleccionados: </h4>
                @if($destinatarios->isnotEmpty())
                    @foreach ($destinatarios as $destinatario)
                     <form action="{{action('SecretariaController@borrar_destinatario', $destinatario['id'])}}" method="post">
                        {{csrf_field()}}    
                        <input name="_method" type="hidden" value="DELETE">
                        
                        <button class='btn red darken-4' type="submit">
                            {{$destinatario->nombre}} 
                        </button>
                    </form> 
                    &nbsp
                    @endforeach
                @else
                    Ninguno
                @endif
      
                <br><br>
      
                <table class='bordered'>
                  <tr>
                    <th width="150">Nombre</th>
                    <th width="100">Agregar destinatario</th>
                  </tr>
                  @foreach ($alumnos as $alumno)

                    <?php $nombre_completo = $alumno->nombres . ' ' . $alumno->apellidos ?>
                    <tr>
      
                      <td>{{$nombre_completo}}</td>
      
                      <td>
                      <a style="position: relative; left: 50px" class='btn-floating waves-effect blue darken-4' href='/secretaria/{{$nombre_completo}}/{{$alumno->email}}/{{$tipo_mail}}/agregar_destinatario' role="button">
                          <i class='material-icons'>add</i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </table>     
              </p>
            </div>
            @if($destinatarios->isnotEmpty())
            <br>
            <form method="get" action="{{ url('/secretaria/enviar_correo') }}">
                <div class="input-field col s12">
                    <textarea id="textarea1" name="mensaje" class="materialize-textarea"></textarea>
                    <label for="textarea1">Mensaje</label>
                </div>
                <input id="tipo_mail" type="hidden" name ="tipo_mail" value="{{$tipo_mail}}" >
                <button class="btn waves-effect waves-light" type="submit">Enviar</button>
                
            </form>
          @endif
          </div>
        </div>
      </div>

                    

@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection