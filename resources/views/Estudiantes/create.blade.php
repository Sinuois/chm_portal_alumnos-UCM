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

  <form action="{{ route('usuario.guarda') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="user_id">usuario</label>
        <input type="text" name="user_id" class="form-control" placeholder="user" required value="{{$user->id}}">
    </div>

    <div class="form-group">
        <label for="curso_id">curso</label>
        <input type="text" name="curso_id" class="form-control" placeholder="curso" required>
    </div>

    <div class="form-group">
        <label for="estado">estado</label>
        <input type="text" name="estado" class="form-control" placeholder="estado" required>
    </div>

    <div class="form-group">
        <label for="estado">motivo</label>
        <input type="text" name="motivo" class="form-control" placeholder="motivo" required>
    </div>

    <div class="form-group">
        <button type="submit">Registrar</button>
    </div>
  </form>
  
@endsection

{{-- Agregamos los scripts para todos los elementos que utilicen JQuery al final para ayudar en tiempos de carga --}}
@section('scripts')

  <script src={{ asset('js/nav_scripts.js') }}></script>

  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  <script>
  
    $('#flash-overlay-modal').modal();
</script>
  


@endsection


