<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Auth Middleware#
Auth::routes();

#Home & Index#
Route::get('/', function () {return view('home');});
Route::get('/home', 'HomeController@index')->name('home');

#Cambiar foto#
Route::patch('/home/perfil/cambio_foto', 'HomeController@cambiar_foto');

#Estudiantes#
Route::get('/estudiante', 'EstudiantesController@index')->name('estudiante');
Route::post('/estudiante/solicitud_practicas', 'EstudiantesController@solicitud_practica')->name('solicitudpractica');
Route::get('/estudiante/practicasofertadas', 'EstudiantesController@catalogopracticas')->name('CatPag');
Route::get('/estudiante/practicasofertadas/detalle', 'EstudiantesController@practicasdetalle')->name('DetallePractica');
Route::get('/estudiante/evaluacionpractica', 'EstudiantesController@evaluacionpractica')->name('EvaluarPractica');
Route::post('/estudiante/evaluacionpractica', 'EstudiantesController@evaluacionpracticaenvio')->name('EvaluarPracticaEnvio');
Route::get('/estudiante/novedadespractica', 'EstudiantesController@novedadespractica')->name('NovedadesPractica');
Route::get('/estudiante/vistopractica', 'EstudiantesController@VistoPractica')->name('VistoPractica');
Route::get('/estudiante/inscripciontesis', 'EstudiantesController@inscripcionestesis');
Route::post('/estudiante/inscripcion/guardar', 'EstudiantesController@guardarinscripcionestesis');
Route::get('/estudiante/inscripciontesis/listado', 'EstudiantesController@listado');
Route::get('/estudiante/inscripciontesis/listado/editar/{id}', 'EstudiantesController@editartesis');
Route::post('/estudiante/inscripciontesis/listado/guardar', 'EstudiantesController@guardarEdicionTesis');
    # toma de ramos
Route::get('/decisionToma',function(){
    return view('Estudiantes.principal');
})->name('toma.decisionToma');
Route::get('/tomacurso','EstudiantesController@tomacurso')->name('usuario.toma');
Route::get('/tomacurso/crea','EstudiantesController@crea_toma_curso')->name('crea.toma');
Route::post('/tomado2','EstudiantesController@modal')->name('usuario.guarda2');
Route::get('tomacurso{id}/destroy',[
    'uses'=>'EstudiantesController@eliminarToma',
    'as'=>'tomacurso.destroy'
]);

Route::get('/botacurso','EstudiantesController@botacurso')->name('usuario.bota');
Route::post('/botado','EstudiantesController@modal2')->name('usuario.guarda3');
Route::get('botacurso{id}/destroy',[
    'uses'=>'EstudiantesController@eliminarBota',
    'as'=>'botacurso.destroy'
]);

#Profesores#
Route::post('/agregar_reserva_profesores', 'ProfesoresController@agregar_reserva');
Route::get('/profesores_listado_reservas', 'ProfesoresController@listado_reservas')->name('Prof_listado_reservas');
Route::get('/profesor', 'ProfesoresController@index')->name('profesor');

Route::get('/profesor/mostrarpracprof', 'ProfesoresController@mostrar_practicas')->name('practicasprofesor');

Route::get('/profesores_reserva', function () {
        return view('Profesores.reserva');
});
Route::get('/profesores_buscar_disponibilidad', function () {
        return view('Profesores.buscar_disponibilidad');
});
Route::post('/agregar_reserva_profesores', 'ProfesoresController@agregar_reserva');
Route::get('/profesores_listado_reservas', 'ProfesoresController@listado_reservas')->name('Prof_listado_reservas');
Route::post('/buscar_disponibilidad_profesores', 'ProfesoresController@buscar_disponibilidad');
Route::get('reserva_profe/{id}/{fi}/{ff}/{nombre}/{capacidad}/{dia_semana}',['as' => 'Profesores.show2', 'uses' => 'ProfesoresController@show2']);
Route::get('profesor_comentario/{id}/destroy',[
    'uses' => 'ProfesoresController@destroycomentario',
    'as'   => 'profesor_comentario.destroy']
);
Route::get('/profesor/inscripciontesis/{id}', 'ProfesoresController@inscripcionestesis');
Route::post('profesor/inscripcion/guardar', 'ProfesoresController@guardarinscripcionestesis');
Route::get('/profesor/inscripciones/detalles', 'ProfesoresController@listadotesis');


#Coordinador de practicas#
Route::get('/profesor/coordinador', 'CoordinadorController@AprobarPracticas')->name('MostrarPracticas');
Route::post('/profesor/coordinador', 'CoordinadorController@CambiarEstado')->name('CambiarEstado');

Route::get('/profesor/coordinador/practicasconcluidasdetalle', 'CoordinadorController@PracticasConcluidasDetalle')->name('PracticasConcluidasDetalle');
Route::get('/profesor/coordinador/PracticaActual','CoordinadorController@PracticaEnCurso')->name('PracticasActuales');
Route::post('/profesor/coordinador/notas', 'CoordinadorController@SubirNotas')->name('SubirNotas');

#Director#
Route::get('/director', 'DirectorController@index')->name('director');
Route::get('/director/inscripciontesis/{id}', 'DirectorController@inscripcionestesis');
Route::post('director/inscripcion/guardar', 'DirectorController@guardarinscripcionestesis');
Route::get('/director/inscripciones/detalles', 'DirectorController@listadotesis');
    # toma de ramos
Route::get('/decisionTomaD','DirectorController@solicitudGrafico')->name('toma.decisionToma2');
Route::get('/directorToma','DirectorController@tomaIndex')->name('director.toma');
Route::put('/directorEdita/{id}','DirectorController@tomaEdit')->name('director.edita');
Route::get('/directorTomaBota','DirectorController@botaIndex')->name('director.bota');
Route::put('/directorEditaBota/{id}','DirectorController@botaEdit')->name('director.botaedita');
Route::get('/directorRamos','DirectorController@ramoIndex')->name('director.cursos');
Route::get('botaramo{id}/destroy','DirectorController@ramoDestroy')->name('director.cursodestroy');
Route::post('/cursoguardado','DirectorController@modal')->name('curso.guardado');
Route::put('/editarcurso/{id}', 'DirectorController@ramoEditar')->name('director.editaRamo');

Route::get('/director/formulario_correo', 'directorController@formulario_correo')->name('director/formulario_correo');
Route::get('/director/{nombre}/{correo}/{tipo_mail}/agregar_destinatario', 'directorController@agregar_destinatario');
Route::get('/director/cambiar_a/{tipo_mail}', 'directorController@cambiar_tipo_mail');
Route::get('/director/busqueda_estudiante_mail', 'directorController@busqueda_estudiante_mail');
Route::delete('/director/{id}/borrar_destinatario', 'directorController@borrar_destinatario');
Route::get('/director/enviar_correo', 'directorController@enviar_correo');

#Secretaria#
Route::get('/secretaria', 'SecretariaController@index')->name('secretaria');
Route::get('/secretaria_reserva', function () {
        return view('Secretaria.reserva');
});
Route::get('/secretaria_agregar_sala', function () {
        return view('Secretaria.agregar_sala');
});
Route::get('/secretaria_buscar_disponibilidad', function () {
        return view('Secretaria.buscar_disponibilidad');
});
Route::get('/secretaria_reportes', function () {
        return view('Secretaria.generar_reportes');
});
Route::get('secretaria_listado_reservas/{id}/destroy',[
    'uses' => 'SecretariaController@destroy',
    'as'   => 'secretaria_listado_reservas.destroy']
);

Route::get('secretaria_listado_reservas/reporte',[
    'uses' => 'SecretariaController@reportes_reservas',
    'as'   => 'secretaria_listado_reservas.reportes_reservas']
);
Route::get('secretaria_historial_sala/{id}/historial',[
    'uses' => 'SecretariaController@historial_sala',
    'as'   => 'secretaria_historial_sala.historial_sala']
);
Route::get('secretaria_exportar_historial/{id}/exportar',[
    'uses' => 'SecretariaController@exportar_sala',
    'as'   => 'secretaria_exportar_historial.exportar_sala']
);

Route::get('secretaria_listado_reserva/{id}/destroy',[
    'uses' => 'SecretariaController@destroy_confirmar_reserva',
    'as'   => 'secretaria_listado_reserva.destroy']
);
Route::get('secretaria_listado_reservas/{id}/edit',[
    'uses' => 'SecretariaController@edit',
    'as'   => 'secretaria_listado_reservas.edit']
);
Route::get('secretaria_notificacion/{id}/notificacion',[
    'uses' => 'SecretariaController@notificacion',
    'as'   => 'secretaria_notificacion.notificacion']
);
Route::get('secretaria_listado_reserva/{id}/edit',[
    'uses' => 'SecretariaController@edit_reserva',
    'as'   => 'secretaria_listado_reserva.edit']
);
Route::post('secretaria_listado_reservas/{id}/update',[
    'uses' => 'SecretariaController@update',
    'as'   => 'secretaria_listado_reservas.update']
);
Route::get('secretaria_listado_salas/{id}/destroy',[
    'uses' => 'SecretariaController@destroysala',
    'as'   => 'secretaria_listado_salas.destroy']
);
Route::get('/secretaria/InscripcionesTesisAprobadas', 'SecretariaController@inscripcionestesis');
Route::get('/secretaria/formulario_correo', 'SecretariaController@formulario_correo')->name('secretaria/formulario_correo');
Route::get('/secretaria/{nombre}/{correo}/{tipo_mail}/agregar_destinatario', 'SecretariaController@agregar_destinatario');
Route::get('/secretaria/cambiar_a/{tipo_mail}', 'SecretariaController@cambiar_tipo_mail');
Route::get('/secretaria/busqueda_estudiante_mail', 'SecretariaController@busqueda_estudiante_mail');
Route::delete('/secretaria/{id}/borrar_destinatario', 'SecretariaController@borrar_destinatario');
Route::get('/secretaria/enviar_correo', 'SecretariaController@enviar_correo');
Route::get('secretaria/imprimir_acta/{id}', 'SecretariaController@imprimir_acta');
Route::get('secretaria/imprimir_formulario/{id}', 'SecretariaController@imprimir_formulario');
Route::post('/secretaria/InscripcionesTesisAprobadas/subir','SecretariaController@subirArchivo')->name('subir');
Route::get('lista_reserva/{id}',['as' => 'lista_reserva.show', 'uses' => 'SecretariaController@show']);
Route::get('/secretaria_listado_reservas', 'SecretariaController@listado_reservas')->name('listado_reservas');
Route::get('/secretaria_listado_salas', 'SecretariaController@listado_salas')->name('listado_salas');
Route::get('/secretaria_confirmar_listado_reservas', 'SecretariaController@confirmar_listado_reservas')->name('confirmar_listado_reservas');
Route::post('/agregar_sala', 'SecretariaController@agregar_sala');
Route::post('/buscar_disponibilidad', 'SecretariaController@buscar_disponibilidad');
Route::post('/agregar_reserva_secretaria', 'SecretariaController@agregar_reserva');
Route::post('/agregar_comentario', 'SecretariaController@comentario');
Route::get('reserva/{id}/{fi}/{ff}/{nombre}/{capacidad}/{dia_semana}',['as' => 'Secretaria.show2', 'uses' => 'SecretariaController@show2']);

#Calendario#
Route::get('Evento/form','ControllerEvent@form');
Route::post('Evento/create','ControllerEvent@create');
Route::get('Evento/details/{id}','ControllerEvent@details');
Route::get('Evento/index','ControllerEvent@index');
Route::get('Evento/index/{month}','ControllerEvent@index_month');


#Empresa#
Route::get('/empresa', 'EmpresaController@index')->name('empresa');
Route::get('/empresa/practicas', 'EmpresaController@CreacionPracticasProfesionales');
Route::post('/empresa/practicas/carga', 'EmpresaController@VerificacionPracticaProfesional');
Route::post('/empresa/practicas/enviar', 'EmpresaController@InsercionPracticaProfesional');
Route::get('/empresa/practicas/mostrar', 'EmpresaController@MostrarPracticas');
Route::post('/empresa/practicas/mostrar', 'EmpresaController@EliminarPracticas');
Route::post('/empresa/practicas/editar', 'EmpresaController@VerificarPracticas');
Route::get('/empresa/practicas/Aceptar', 'EmpresaController@AceptarPracticas');
Route::get('/empresa/practicas/mostrarP', 'EmpresaController@MostrarPracticantes');
Route::get('/empresa/practicas/mostrarR', 'EmpresaController@MostrarRetroalimentacion');
Route::post('/empresa/practicas/mostrarR', 'EmpresaController@DetalleRetroalimentacion');
Route::post('/empresa/practicas/editar', 'EmpresaController@VerificarPracticas');
Route::get('/empresa/practicas/mostrar_finalizadas', 'EmpresaController@MostrarPracticasFinalizadas')->name('practicasfinalizadasempresa');
Route::get('/empresa/practicas/finalizadas_evaluacion', 'EmpresaController@PracticasEvaluacion')->name('practicasevaluacion');
Route::post('/empresa/practicas/evaluacionempresa', 'EmpresaController@Evaluacion')->name('evaluacionempresa');
Route::post('/empresa/practicas/accion', 'EmpresaController@Accion');

#Coordinador de practicas#
Route::get('/profesor/coordinador', 'CoordinadorController@AprobarPracticas')->name('AprobarPracticas');
Route::post('/profesor/coordinador', 'CoordinadorController@CambiarEstado')->name('CambiarEstado');
Route::get('/profesor/coordinador/addE', 'CoordinadorController@AddEmpresa')->name('AddEmpresa');
Route::post('/profesor/coordinador/addE', 'CoordinadorController@NuevaEmpresa')->name('NuevaEmpresa');
Route::get('/profesor/practicas', 'CoordinadorController@VerPracticas')->name('VerPracticas');
Route::get('/profesor/practicas/detalle', 'CoordinadorController@DetallePracticas')->name('DetalleCoordinacionPractica');
Route::post('/profesor/EliminarPractica', 'CoordinadorController@EliminarPractica')->name('EliminarPractica');

