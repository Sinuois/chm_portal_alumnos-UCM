{{-- Mantenemos estandar base --}}
@extends('layout.master')

{{-- Cambiamos titulo de pagina --}}
@section('title')
  <title>Estudiante</title>
@endsection

{{-- Incluimos los archivos a utilizar para front --}}
@section('styles')
  @include('layout.materialize') {{-- De usar materialize, incluimos desde el layout --}}
@endsection

{{-- Aqui trabajamos todo el contenido de la vista --}}
@section('body')
  {{-- Contenido --}}

<ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul>
<div class="center">
<a href="{{route('usuario.toma')}}" class="waves-effect waves-light btn-large"><i class="material-icons left"></i>Tomar ramos</a>
<a href="{{route('usuario.bota')}}" class="waves-effect waves-light btn-large"><i class="material-icons right"></i>Eliminar ramos</a>
</div>

<br>
<br>
<br>
<br>


@endsection
@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection
