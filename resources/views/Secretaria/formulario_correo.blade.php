{{-- Restriccion de acceso - Leer comentario en layout.redirect-- }} No sé por qué denega el acceso por ahora
{{-- @include('layout.redirect') --}} 

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
              
      
                <h2 class='center-align'>Seleccionar alumnos para envío de correo</h2>
                <h4>Alumnos seleccionados: </h4>
                @if (!empty($destinatarios))
                    @foreach ($destinatarios as $destinatario)
                        {{$destinatario->nombre}}
                    @endforeach
                @endif
      
                <br><br>
      
                <table class='bordered'>
                  <tr>
                    <th width="150">Nombre</th>
                    <th width="100">Agregar destinatario</th>
                  </tr>
                  @foreach ($alumnos as $alumno)
                    <tr>
      
                      <td>{{$alumno->apellidos}}</td>
      
                      <td>
                      <a class='btn-floating waves-effect blue darken-4' href='/secretaria/{{$alumno->apellidos}}/{{$alumno->email}}/agregar_destinatario' role="button">
                          <i class='material-icons'>add</i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </table>     
              </p>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" onclick="window.location.href='/secretaria/enviar_correo'">Enviar</button>               

@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection