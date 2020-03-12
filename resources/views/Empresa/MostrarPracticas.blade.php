{{-- Restriccion de acceso --}}

@if(Auth::check())
  @if(Auth::user()->tipo_usuario != 'empresa')
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
  <title>Creacion Practicas Profesionales</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')

@if(session('errores'))
  <div class="card-panel teal accent-1">
    Practica Profesional creada correctamente
  </div>
@endif
@if(session('Eliminado'))
  <div class="card-panel red accent-1">
    Practica Profesional eliminada correctamente
  </div>
@endif
@if(session('update'))
  <div class="card-panel blue accent-1">
    Practica Profesional actualizada correctamente
  </div>
@endif
<br>
<div class="container">
  <div class="card-panel center">
    <div class="header">
      <h4 class="title">Lista de Prácticas</h4>
    </div>
    <table class="table-border table-striped responsive-table centered">
      <thead>
        <tr>
          <th>Actividad Principal</th>
          <th>Enfoque y conocimientos</th>
          <th>Fecha Publicacion</th>
          <th>Estado</th>
          {{-- <th>Acción</th> --}}
        </tr>
      </thead>
      <tbody>
       
          @foreach ($Practicas as $practica)
            <tr >
              <form action="{{url('/empresa/practicas/mostrar')}}" method="post">
                  <input name="id" value={{$practica->id}} type="hidden">
                  <td style="text-align: center"> {{$practica->Actividad1}}</td>
                  <td style="text-align: center"> {{$practica->Enfoque}}</td>
                  @php
                      $tiempo = \Carbon\Carbon::parse($practica->updated_at)->diffForHumans();
                  @endphp
                  <td style="text-align: center"> {{ucfirst($tiempo)}} </td>
                  <td style="text-align: center"> {{$practica->Estado}}</td>
                  {{-- <td style="text-align: center"><button name="view_button" id="view_button" class="waves-effect orange btn" type="submit">
                    <i class="material-icons">visibility</i></button>                    
                    <button name="update_button" class="waves-effect blue btn" type="submit">
                    <i class="material-icons" >edit</i></button>
                    <button name="delete_button" class="waves-effect red btn" type="submit">
                    <i class="material-icons">cancel</i></button>
              </button></td> --}}
            </form>
          @endforeach
      </tbody>
    </table>
  </div>
</div>


</div>
@endsection
        
@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
  <script src={{ asset('js/table_scripts.js') }}></script>
@endsection
