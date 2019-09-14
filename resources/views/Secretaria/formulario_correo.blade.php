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
                <h3 class='center-align'>Seleccionar alumnos para envío de correo</h3>
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
            @if($destinatarios->isnotEmpty())
            <br>
            <form method="get" action="{{ url('/secretaria/enviar_correo') }}">
                <div class="input-field col s12">
                    <textarea id="textarea1" name="mensaje" class="materialize-textarea"></textarea>
                    <label for="textarea1">Mensaje</label>
                </div>
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