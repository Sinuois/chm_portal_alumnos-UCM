<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                                <h4 class="title" aling="center"> <center>    UNIVERSIDAD CATÓLICA DEL MAULE
                                                      FACULTAD DE CIENCIAS DE LA INGENIERÍA
                                                    ESCUELA DE INGENIERÍA CIVIL INFORMÁTICA </center>
                                 </h4>
                        
                            <div>
                              <h5>FORMULARIO DE INSCRIPCIÓN DE TEMAS DE TESIS Y MEMORIAS DE TÍTULO</h5>
                            </div>
                            <div c>
                            <p>

                              @foreach ($d_alumno as $alumno)

                                  NOMBRE COMPLETO: {{$alumno->nombres}} {{$alumno->apellidos}}

                             @endforeach
                            </p>

                             <p>

                              @foreach ($d_alumno as $alumno)

                                  RUT: {{$alumno->rut}} 
                                  AÑO DE INGRESO: {{$alumno->fecha_ingreso}} 
                                  CARRERA: INGIENERIA CIVIL INFORMATICA
                                  EMAIL: {{$alumno->email}} 
                                  TELEFONO: {{$alumno->telefono}}

                             @endforeach
                            </p>
                            <p>
                              @foreach ($d_inscripcion as $inscripcion)

                                 <p> NOMBRE DE TESIS/MEMORIA: {{$inscripcion->Nombre_tesis}} </p>
                                 <p> BREVE DESCRIPCIÓN DEL TEMA:: {{$inscripcion->DescripcionTesis}} </p>
                                 <p>OBJETIVOS DEL TEMA: {{$inscripcion->ObjetivosTema}}  </p>
                                 <p>CONTRIBUCIÓN ESPERADA:: {{$inscripcion->ContribucionEsperada}}  </p>

                             @endforeach
                            </p>

                             <p>
                               FIRMA ALUMNO 
                               FECHA: …......../ …...... / …............-   
                             </p>

                             <p>

                               @foreach ($d_profesor as $profesor)
                               <p> PROFESOR GUÍA: {{$profesor->nombres}} {{$profesor->apellidos}}, </p>
                               <p> RUT:{{$profesor->rut}} </p>
                               @endforeach 
                               
                             </p>

                                 <p>

                              @foreach ($d_inscripcion as $inscripcion)

                              COMISIÓN SUGERIDA POR PROFESOR GUÍA:

                              <p> 1) {{$inscripcion->Comision1}} </p>
                                  <p> 2) {{$inscripcion->Comision2}} </p>
                                  <p> 3) {{$inscripcion->Comision3}} </p>
                                  <p> 4) EXTERNO:

                                 <p> NOMBRE:.....................................................................................................................- </p>

                                 <p> CORREO: …...................................................................................................................- </p>

                                 <p> INSTITUCIÓN: …..............................................................................................................- </p>

                                 <p> DIRECCION POSTAL: ….........................................................................................................- </p>

                             @endforeach
                            </p>
                            <div class="container">
                               <p>
                              <div class="col-lg-12">
                             <p>   ___________________                                                                ________________</p>                                                                        
                               <p>  PROFESOR GUÍA                                                                      DIRECTOR DE ESCUELA  </p>
                              </div>
                            </div>
                            <p> FECHA: …......../ …...... / …............-       |     FECHA: …......../ …...... / …............-    </p>
                            

                            </p>

                            <p>
                              

                            <p> OBSERVACIONES DEL DIRECTOR DEL DEPARTAMENTO:</p>






                            <p> FIRMA DIRECTOR DEL DEPARTAMENTO</p>


                            <p>     FECHA: …......../ …...... / …............-    </p>
                            </p>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection


















