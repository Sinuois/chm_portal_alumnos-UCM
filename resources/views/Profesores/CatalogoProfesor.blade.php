{{-- Restriccion de acceso --}}

@extends('layout.master')

@section('title')
  <title>Coordinador de practicas</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
<div>
  <div class="container section">
    <div class="col s12 m8">
      <div class="card-panel " style="background-color: #253e85;">
        <span class="white-text">Bienvenido {{Auth::user()->nombres}} aqui se muestran las practicas que actualmente cuentan con postulaciones abiertas.
        </span>
      </div>
    </div>
  </div>
  <div class="container centered">
    <div class="card-panel center">
      <div class="header">
        <h4 class="title">Catálogo de Prácticas</h4>
      </div>
      <div class="content centered">
        <table class="table-border table-striped responsive-table centered" >
          
            <tr >
              <th style="text-align: center">Empresa</th>
              <th style="text-align: center">Actividad Principal</th>
              <th style="text-align: center">Enfoque y conocimientos</th>
              <th style="text-align: center">Fecha Publicacion</th>
              <th style="text-align: center">Cantidad de Solicitudes</th>
              <th style="text-align: center"></th>
            </tr>
          
          <tbody>
            
                @foreach ($Coleccion as $practica)
                  <tr>
                    <td> {{$practica->empresa->nombres}}</td>
                    <td> {{$practica->Actividad1}}</td>
                    <td> {{$practica->Enfoque}}</td>
                    <td> {{\Carbon\Carbon::parse($practica->updated_at)->diffForHumans()}} </td>
                    <td> {{$practica->PostulacionPractica->count()}}</td>
                    <td>
                      <a href="{{route('DetalleCoordinacionPractica',['id' => $practica->id])}}" class="btn waves-effect waves-light" style="background-color: #253e85;">Detalles</a>
                    </td>
                @endforeach
           
          </tbody>
        </table>
      </div>
        <div class="container">
          <div class="centered">
          @include('layout.pagination')
          </div>
        </div>
    </div>
  </div>
</div>

{{--Alerta de pagina de practicas sin datos--}}
@include('layout.alert')

@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
  @if(empty($Coleccion->total()))
    <script type="text/javascript" Cabecera="¡¡Error!!" TextoBajada="No hay practicas por el momento, intenta más tarde" Redirec="/estudiante" src={{ asset('js/alert.js') }}></script>
  @endif
@endsection