
@extends('layout.master')

@section('title')
  <title>Detalles Tesis</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
    <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header center">
                              <br>
                                <h4 class="title">Tesis inscritas</h4>
                                <br>
                            </div>
                            <div class="content">
                              <form>
                                      <table class="table table-bordered">


                                     <table class="table-border table-striped responsive-table centered">
                                                            <thead>
                                                              <tr>
                                                                <th>Codigo Inscripcion</th>
                                                                <th>Semestre</th>
                                                                <th>Fecha Publicacion</th>
                                                                <th>Estado</th>
                                                                <th>revisar</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                     @foreach ($inscripciones as $inscripcion)
                                                                
                                                                          <tr>
                                                                            <td style="text-align: center">{{$inscripcion->CodigoIncripcion}} </td>
                                                                            <td style="text-align: center">{{$inscripcion->Semestre}} </td>
                                                                            <td style="text-align: center">{{$inscripcion->FechaInscripcion}} </td>
                                                                            <td style="text-align: center">{{$inscripcion->Estado}} </td>
                                                                            <td style="text-align: center">
                                                                              <a href="{{ url("/profesor/inscripciontesis/{$inscripcion->id}")}}" class="btn waves-effect waves-light" style="background-color: #253e85;">revisar</a>
                                                                          </td>
                                                                     
                                                                      @endforeach
                                                                   
                                                            </tbody>
                                                </table>
                            </table>

                            <div align='center'>
                              {{$inscripciones->links('vendor.pagination.materializecss')}}
                            </div>
                            
                           

                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection












