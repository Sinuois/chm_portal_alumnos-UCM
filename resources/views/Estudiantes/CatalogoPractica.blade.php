{{-- Restriccion de acceso --}}

@extends('layout.master')

@section('title')
  <title>Perfil Estudiante</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
<div>
  <div class="row">
    <div class="col s12 m8">
      <div class="card-panel" style="background-color: #253e85; position: relative; left: 250px">
        <span class="white-text">Bienvenido {{Auth::user()->nombres}} tenemos una cartilla de ofertas
          para tu Coleccion, puedes dar click a una oferta para revisar en detalle y además realizar tu postulación.
        </span>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="card-panel  center">
      <div class="header">
        <h4 class="title">Listado De Prácticas</h4>
    </div>
    <div class="content">
        <table class="table table-striped table-responsive table-hover centered">
          <thead class="centered">
            <tr>
              <th>Empresa</th>
              <th>Actividad Principal</th>
              <th>Enfoque y conocimientos</th>
              <th>Fecha Publicacion</th>
              <th style="text-align: center">Cantidad de Solicitudes</th>
              <th>Detalles</th>
            </tr>
          </thead>
          <div class="center">
          <tbody>
            <thead>
                @foreach ($Coleccion as $practica)
                  <tr>
                    <td style="text-align: center"> {{$practica->empresa->nombres}}</td>
                    <td style="text-align: center"> {{$practica->Actividad1}}</td>
                    <td style="text-align: center"> {{$practica->Enfoque}}</td>
                    <td style="text-align: center"> {{\Carbon\Carbon::parse($practica->updated_at)->diffForHumans()}} </td>
                    <td style="text-align: center"> {{$practica->PostulacionPractica->count()}}</td>
                    <td style="text-align: center">
                      <a href="{{route('DetallePractica',['id' => $practica->id])}}" class="btn waves-effect waves-light" style="background-color: #253e85; text-align: center">Click Aquí</a>
                    </td>
                @endforeach
            </thead>
          </tbody>
        </div>
        </table>
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