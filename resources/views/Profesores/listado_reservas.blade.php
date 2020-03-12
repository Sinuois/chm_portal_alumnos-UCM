
@extends('layout.master')

@section('title')
  <title>Listado Reservas</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
    <div class="container">
                    <div class="col-md-16">
                        <div class="card-panel center">
                            <div class="header">
                                <h4 class="title">Mis Reservas</h4>
                            </div>
                            <div class="content">
                              <form>
                                  <div class="content table-responsive table-full-width centered">
                                      <table class="table table-hover table-striped centered" >
                                          <th style="text-align: center" >Nombre Sala</th>
                                          <th style="text-align: center">Bloque</th>
                                          <th style="text-align: center">Dia</th>
                                          <th style="text-align: center">Fecha Inicio</th>
                                          <th style="text-align: center">Fecha Salida</th>
                                          
                                      <tbody>
                                      @foreach($reserva as $reser) <!--recorre todos los registros encontrados y los muestra en la vista-->
                                      
                                        @if($reser->id_user == ( Auth::user()->id))
                                          @if( $reser->estado == 1 or $reser->estado == 3)
                                            <tr>
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

                                            <td>{{$reser->fecha_ingreso}}</td>
                                            <td>{{$reser->fecha_salida}}</td>
                                            </tr>
                                          @endif
                                        @endif
                                      @endforeach
                                      </tbody>
                                      </table>
                                  </div>
                                  <div class="clearfix"></div>
                              </form>
                            </div>
                        </div>
                    </div>
    </div>

@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection
