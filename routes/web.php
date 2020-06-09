<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Estaticas@index')->name('home');
Route::get('/registro', 'Estaticas@registro')->name('registro');
Route::post('/guardar-registro', 'Estaticas@guardarRegistro')->name('guardarRegistro');
Route::get('/ver-formulario-registro-pdf/{id}', 'Estaticas@verFormularioRegistroPdf')->name('verFormularioRegistroPdf');
Route::get('/descargar-formulario-registro-pdf/{id}', 'Estaticas@descargarFormularioRegistroPdf')->name('descargarFormularioRegistroPdf');



Auth::routes(['verify' => true,'register' => false]);

// @deivid, usuariso que no tengan registros
Route::middleware(['verified', 'auth'])->group(function () {
    
    // @deivid , perfil de usuario
    Route::get('/mi-perfil', 'MiPerfil@index')->name('miperfil');
    Route::get('/mi-perfil-informacion-personal', 'MiPerfil@personal')->name('miPerfilInfoPersonal');
    Route::post('/actualizar-mi-perfil-informacion-personal', 'MiPerfil@actualizarInfoPersonal')->name('actualizarMiPerfilInfoPersonal');
    Route::get('/mi-perfil-informacion-laboral', 'MiPerfil@laboral')->name('miPerfilInfoLaboral')->withoutMiddleware(['informacion_user']);
    Route::post('/actualizar-mi-perfil-informacion-laboral', 'MiPerfil@actualizarInfoLaboral')->name('actualizarMiPerfilInfoLaboral');
    Route::get('/mi-perfil-informacion-academica', 'MiPerfil@academica')->name('miPerfilInfoAcademica');
    Route::post('/guardar-mi-perfil-informacion-academica', 'MiPerfil@guardarInfoAcademica')->name('guardarMiPerfilInfoAcademica');
    Route::get('/editar-mi-perfil-informacion-academica/{id}', 'MiPerfil@editarAcademica')->name('editarInfoAcademica');
    Route::post('/actualizar-mi-perfil-informacion-academica', 'MiPerfil@actualizarInfoAcademica')->name('actualizarMiPerfilInfoAcademica');
    Route::get('/eliminar-mi-perfil-informacion-academica/{id}', 'MiPerfil@eliminarAcademica')->name('eliminarInfoAcademica');
    Route::get('/mi-perfil-hoja-vida', 'MiPerfil@hojaVida')->name('hojaVidaMiPerfil');
});

// @deivid usuarios que tengan registos, deben actualizar perfil
Route::middleware(['verified', 'auth','informacion_user'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    
    
    
    // @deivid, roles solo administrador
    Route::get('/roles', 'Roles@index')->name('roles');
    Route::post('/guardar-rol', 'Roles@guardar')->name('guardarRol');
    Route::get('/permisos/{rol}', 'Roles@permisos')->name('permisos');
    Route::post('/asignar-permisos-rol', 'Roles@sincronizar')->name('sincronizarPermiso');
    Route::get('/eliminar-rol/{rol}', 'Roles@eliminar')->name('eliminarRol');
    // importar datos excel
    Route::get('/importar-datos-excel', 'Roles@importarDatosExcel')->name('importarDatosExcel');
    Route::post('/guardar-importar-datos-excel', 'Roles@guargarImportacionDatosExcel')->name('guargarImportacionDatosExcel');
    
    
    
    

    // @deivid, usuarios solo permiso=Usuarios
    Route::get('/usuarios/{rol?}', 'Usuarios@index')->name('usuarios');
    Route::get('/nuevo-usuario', 'Usuarios@nuevo')->name('nuevoUsuario');
    Route::post('/guardar-usuario', 'Usuarios@guardar')->name('guardarUsuario');
    Route::get('/editar-usuario/{user}', 'Usuarios@editar')->name('editarUsuario');
    Route::post('/actualizar-usuario', 'Usuarios@actualizar')->name('actualizarUsuario');    
    Route::get('/eliminar-usuario/{user}', 'Usuarios@eliminar')->name('eliminarUsuario');
    Route::get('/importar-usuario', 'Usuarios@importar')->name('importarUsuario');
    Route::post('/guardar-importar-usuario', 'Usuarios@importarGuardar')->name('guargarImportacionUsuarios');
    

    // @deivid, solo usuarios solo permiso=Maestrías
    Route::get('/maestrias', 'Maestrias@index')->name('maestrias');
    Route::get('/nuevo-maestria', 'Maestrias@nuevo')->name('nuevaMaestria');
    Route::post('/guardar-maestria', 'Maestrias@guardar')->name('guardarMaestria');
    Route::get('/editar-maestria/{id}', 'Maestrias@editar')->name('editarMaestria');
    Route::post('/actualizar-maestria', 'Maestrias@actualizar')->name('actualizarMaestria');
    Route::get('/eliminar-maestria/{id}', 'Maestrias@eliminar')->name('eliminarMaestria');


    // @deivi, solo usuarios permiso=Maestrías
    Route::get('/materias/{maestria}', 'Materias@index')->name('materias');
    Route::post('/guardar-materia', 'Materias@guardar')->name('guardarMateria');
    Route::get('/editar-materia/{materia}', 'Materias@editar')->name('editarMateria');
    Route::post('/actualizar-materia', 'Materias@actualizar')->name('actualizarMateria');
    Route::get('/eliminar-materia/{materia}', 'Materias@eliminar')->name('eliminarMateria');


    // @deivid, solo usuarios solo permiso=Maestrías
    Route::get('/cohortes/{maestria}', 'Cohortes@index')->name('cohortes');
    Route::get('/nuevo-cohorte/{maestria}', 'Cohortes@nuevo')->name('nuevaCohorte');
    Route::post('/guardar-cohorte', 'Cohortes@guardar')->name('guardarCohorte');
    Route::get('/editar-cohorte/{cohorte}', 'Cohortes@editar')->name('editarCohorte');
    Route::get('/eliminar-cohorte/{cohorte}', 'Cohortes@eliminar')->name('eliminarCohorte');
    Route::post('/actualizar-cohorte', 'Cohortes@actualizar')->name('actualizarCohorte');
    
    // @deivid, banco de preguntas    
    Route::get('/banco-preguntas/{cohorte}', 'BancoPreguntas@index')->name('bancoPreguntas');
    Route::post('/banco-preguntas-actualizar', 'BancoPreguntas@actualizar')->name('actualizarBancoPregunta');
    Route::post('/banco-preguntas-guardar', 'BancoPreguntas@guardar')->name('guardarBancoPregunta');
    Route::get('/banco-preguntas-eliminar/{id}', 'BancoPreguntas@eliminar')->name('eliminarBancoPregunta');
    
    // @deivid , admision
    Route::get('/admision/{cohorte}', 'Admisiones@index')->name('admision');
    Route::post('/actualizar-examen-admision', 'Admisiones@actualizarExamen')->name('actualizarExamenAdmision');
    
    

    // @deivid, paralelos
    Route::get('/paralelos/{cohorte}', 'Paralelos@index')->name('paralelos');
    Route::post('/guardar-paralelo', 'Paralelos@guardar')->name('guardarParalelo');
    Route::get('/eliminar-paralelo/{paralelo}', 'Paralelos@eliminar')->name('eliminarParalelo');
    Route::get('/editar-paralelo/{paralelo}', 'Paralelos@editar')->name('editarParalelo');
    Route::post('/actualizar-paralelo', 'Paralelos@actualizar')->name('actualizarParalelo');
    
    // @deivid, malla curricular
    Route::get('/malla-curricular/{paralelo}', 'MallaCurriculares@index')->name('mallaCurricular');
    Route::get('/nueva-malla-curricular/{paralelo}', 'MallaCurriculares@nuevo')->name('nuevoMallaCurricular');
    Route::post('/guardar-malla-curricular', 'MallaCurriculares@guardar')->name('guardarMallaCurricular');
    Route::get('/editar-malla-curricular/{malla}', 'MallaCurriculares@editar')->name('editarMallaCurricular');
    Route::post('/actualizar-malla-curricular', 'MallaCurriculares@actualizar')->name('actualizarMallaCurricular');
    Route::get('/eliminar-malla-curricular/{malla}', 'MallaCurriculares@eliminar')->name('eliminarMallaCurricular');


    // @deivid, mis registros
    Route::get('/mis-resgistros', 'Registros@misRegistros')->name('misRegistros');
    Route::get('/subir-comprobante-de-registro/{registro}', 'Registros@subirComprobanteRegistro')->name('subirComprobanteRegistro');
    Route::post('/guardar-comprobante-de-registro', 'Registros@guardarComprobanteRegistro')->name('guardarComprobanteRegistro');

    // @deivid, mis inscripciones
    Route::get('/mis-inscripciones', 'MisInscripciones@index')->name('misInscripciones');
    Route::get('/mis-inscripciones-ver-formulario/{inscripcion}', 'MisInscripciones@verFormulario')->name('misInscripcionesVerFormulario');
    
    // @deivid, mis admisiones
    Route::get('/mis-admisiones', 'MisAdmisiones@index')->name('misAdmisiones');
    Route::get('/mis-admisiones-subir-comprobante-de-matricula/{admision}', 'MisAdmisiones@subirComprobanteParaMatricula')->name('subirComprobanteParaMatricula');
    Route::post('/mis-admisiones-guardar-comprobante-para-matricula', 'MisAdmisiones@guardarComprobanteParaMatricula')->name('guardarComprobanteParaMatricula');
    
    


    // @deivid, validar registrso
    Route::get('/validar-registros', 'ValidarRegistros@index')->name('validarRegistros');
    Route::post('/obtener-cohortes-x-maestria-validar-registros', 'ValidarRegistros@obtenerCohortesMaestria')->name('obtenerCohortesMaestriaValidarRegistro');
    Route::get('/obtener-registro-x-cohorte-validar-registro/{cohorte}', 'ValidarRegistros@obtenerRegistroPorCohorte')->name('obtenerRegistroPorCohorteValidarRegistro');
    Route::post('/guardar-validar-registro', 'ValidarRegistros@validarRegistro')->name('guardarValidarRegistro');

    // @deivid, realizar inscripciones
    Route::get('/realizar-inscripciones', 'Inscripciones@index')->name('realizarInscripciones');
    Route::post('/obtener-cohortes-x-maestria-incripcion', 'Inscripciones@obtenerCohortesMaestria')->name('obtenerCohortesMaestriaInscripcion');
    Route::get('/obtener-registros-x-cohorte-incripcion/{cohorte}', 'Inscripciones@obtenerRegistrosCohorte')->name('obtenerRegistrosCohorteInscripcion');
    Route::get('/listado-inscripciones/{cohorte}', 'Inscripciones@listado')->name('listadoInscripciones');
    Route::get('/nueva-inscripcion/{reg}', 'Inscripciones@nuevo')->name('nuevaInscripcion');
    Route::get('/hoja-vida-inscripcion/{reg}', 'Inscripciones@hojaVida')->name('hojaVidaInscripcion');
    Route::get('/formulario-registro-inscripcion/{reg}', 'Inscripciones@formularioRegistro')->name('formularioRegistroInscripcion');
    Route::post('/inscribir-guardar', 'Inscripciones@guardar')->name('guardarInscripcion');
    Route::get('/inscripcion-eliminar/{id}', 'Inscripciones@eliminar')->name('eliminarInscripcion');
    Route::get('/inscripcion-ver/{id}', 'Inscripciones@ver')->name('verInscripcion');
    Route::get('/formulario-inscripcion/{id}', 'Inscripciones@formularioInscripcion')->name('formularioInscripcion');
    Route::post('/inscribir-actualizar', 'Inscripciones@actualizar')->name('actualizarInscripcion');
    Route::get('/listado-inscripciones-pdf/{cohorte}', 'Inscripciones@pdf')->name('pdfInscripciones');

    // @deivid
    Route::get('/validar-matriculas', 'ValidarMatriculas@index')->name('validarMatriculas');
    Route::post('/obtener-cohortes-x-maestria-validar-matricula', 'ValidarMatriculas@obtenerCohortesMaestria')->name('obtenerCohortesMaestriaValidarMatricula');
    Route::get('/obtener-registros-x-cohorte-matriculas/{cohorte}', 'ValidarMatriculas@obtenerAdmisionesCohorte')->name('obtenerAdmisionesPorCohorteValidarRegistro');
    Route::post('/guardar-validar-matricula', 'ValidarMatriculas@validarMatricula')->name('guardarValidarMatricula');
    
    
    
    
    // @deivid, mis maestrias
    Route::get('/mis-maestrias', 'MisMaestrias@index')->name('misMaestrias');
    Route::get('/mis-maestrias-registros/{cohorte}', 'MisMaestrias@registros')->name('miCohorteRegistros');
    Route::get('/mis-maestrias-inscritos/{cohorte}', 'MisMaestrias@inscritos')->name('miCohorteInscritos');
    Route::get('/mis-maestrias-admision/{cohorte}', 'MisMaestrias@admision')->name('miCohorteAdmision');
    Route::get('/atender-entrevista-y-ensayo/{admision}', 'MisMaestrias@admisionAtender')->name('miCohorteAdmisionEntrevistaEnsayo');
    Route::post('/mis-maestrias-admision-atender-entrevista-actualizar', 'MisMaestrias@admisionActualizarEntrevista')->name('miCohorteAdmisionEntrevistaActualizar');
    Route::post('/mis-maestrias-admision-atender-ensayo-actualizar', 'MisMaestrias@admisionActualizarEnsayo')->name('miCohorteAdmisionEnsayoActualizar');
    Route::post('/mis-maestrias-admision-atender-ensayo-aprobar-reprobar', 'MisMaestrias@admisionAprobarReprobar')->name('miCohorteAdmisionAprobarReprobar');
    Route::get('/ver-hojaVida-inscripcion-mis-maestrias/{inscripcion}', 'MisMaestrias@verHojaVidaInscripcionMisMaestrias')->name('verHojaVidaInscripcionMisMaestrias');
    
    
    
    
});