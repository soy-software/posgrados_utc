<?php

// BIENVENIDO
Breadcrumbs::for('bienvenido', function ($trail) {
    $trail->push('Bienvenido', url('/'));
});

// Inicio
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});

// auth
Breadcrumbs::for('registro', function ($trail) {
    $trail->parent('bienvenido');
    $trail->push('Registro', route('registro'));
});
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('bienvenido');
    $trail->push('Acceder', url('/login'));
});
Breadcrumbs::for('resetPassword', function ($trail) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', url('/password/reset'));
});



// Roles y permisos
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles'));
});
Breadcrumbs::for('permisos', function ($trail,$rol) {
    $trail->parent('roles');
    $trail->push('Permisos en '.$rol->name, route('permisos',$rol->id));
});

// importar datos de excel
Breadcrumbs::for('importarDatosExcel', function ($trail) {
    $trail->parent('home');
    $trail->push('Importar datos de excel', route('importarDatosExcel'));
});


// usuarios
Breadcrumbs::for('usuarios', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios'));
});
Breadcrumbs::for('nuevoUsuario', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Nuevo usuario', route('nuevoUsuario'));
});
Breadcrumbs::for('editarUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Editar usuario', route('editarUsuario',$user->id));
});
Breadcrumbs::for('importarUsuario', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Importar usuario', route('importarUsuario'));
});


// maestrias

Breadcrumbs::for('maestrias', function ($trail) {
    $trail->parent('home');
    $trail->push('Maestrías', route('maestrias'));
});

Breadcrumbs::for('nuevaMaestria', function ($trail) {
    $trail->parent('maestrias');
    $trail->push('Maestrías', route('nuevaMaestria'));
});
Breadcrumbs::for('editarMaestria', function ($trail,$maestria) {
    $trail->parent('maestrias');
    $trail->push('Editar maestría', route('editarMaestria',$maestria->id));
});

// cohortes

Breadcrumbs::for('cohortes', function ($trail,$maestria) {
    $trail->parent('maestrias');
    $trail->push('Cohortes de '.$maestria->nombre, route('cohortes',$maestria->id));
});
Breadcrumbs::for('nuevaCohorte', function ($trail,$maestria) {
    $trail->parent('cohortes',$maestria);
    $trail->push('Nueva Cohorte', route('nuevaCohorte',$maestria->id));
});
Breadcrumbs::for('editarCohorte', function ($trail,$cohorte) {
    $trail->parent('cohortes',$cohorte->maestria);
    $trail->push('Editar Cohorte', route('editarCohorte',$cohorte->id));
});

// materias
Breadcrumbs::for('materias', function ($trail,$maestria) {
    $trail->parent('maestrias');
    $trail->push('Materías', route('materias',$maestria->id));
});
Breadcrumbs::for('editarMateria', function ($trail,$materia) {
    $trail->parent('materias',$materia->maestria);
    $trail->push('Editar matería', route('editarMateria',$materia->id));
});

// paralelos
Breadcrumbs::for('paralelos', function ($trail,$cohorte) {
    $trail->parent('cohortes',$cohorte->maestria);
    $trail->push('Paralelos de cohorte '.$cohorte->numero, route('paralelos',$cohorte->id));
});
Breadcrumbs::for('editarParalelo', function ($trail,$paralelo) {
    $trail->parent('paralelos',$paralelo->cohorte);
    $trail->push('Editar paralelo '.$paralelo->nombre, route('editarParalelo',$paralelo->id));
});


// malla curricular

Breadcrumbs::for('mallaCurricular', function ($trail,$paralelo) {
    $trail->parent('paralelos',$paralelo->cohorte);
    $trail->push('Malla curricular paralelo '.$paralelo->nombre, route('mallaCurricular',$paralelo->id));
});
Breadcrumbs::for('nuevoMallaCurricular', function ($trail,$paralelo) {
    $trail->parent('mallaCurricular',$paralelo);
    $trail->push('Nuevo malla curricular', route('nuevoMallaCurricular',$paralelo->id));
});
Breadcrumbs::for('editarMallaCurricular', function ($trail,$malla) {
    $trail->parent('mallaCurricular',$malla->paralelo);
    $trail->push('Editar malla curricular', route('editarMallaCurricular',$malla->id));
});


// @deivid, mis registros
Breadcrumbs::for('misRegistros', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis registros', route('misRegistros'));
});
Breadcrumbs::for('subirComprobanteRegistro', function ($trail,$reg) {
    $trail->parent('misRegistros');
    $trail->push('Subir comprobante de registro', route('subirComprobanteRegistro',$reg->id));
});

// @deivid, mis inscripciones
Breadcrumbs::for('misInscripciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis inscripciones', route('misInscripciones'));
});

// @deivid, mis admisiones
Breadcrumbs::for('misAdmisiones', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis admisiones', route('misAdmisiones'));
});
Breadcrumbs::for('subirComprobanteParaMatricula', function ($trail,$admision) {
    $trail->parent('misAdmisiones');
    $trail->push('Subir comprobante de matrícula', route('subirComprobanteParaMatricula',$admision));
});


// @deivid, validar registro
Breadcrumbs::for('validarRegistros', function ($trail) {
    $trail->parent('home');
    $trail->push('Validar registros', route('validarRegistros'));
});

// @deivid, validar matricula
Breadcrumbs::for('validarMatriculas', function ($trail) {
    $trail->parent('home');
    $trail->push('Validar matriculas', route('validarMatriculas'));
});

// @deivid, perfil de usuario
Breadcrumbs::for('miperfil', function ($trail) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('miperfil'));
});
Breadcrumbs::for('miPerfilInfoPersonal', function ($trail) {
    $trail->parent('miperfil');
    $trail->push('Información personal', route('miPerfilInfoPersonal'));
});
Breadcrumbs::for('miPerfilInfoLaboral', function ($trail) {
    $trail->parent('miperfil');
    $trail->push('Información laboral', route('miPerfilInfoLaboral'));
});
Breadcrumbs::for('miPerfilInfoAcademica', function ($trail) {
    $trail->parent('miperfil');
    $trail->push('Información académica', route('miPerfilInfoAcademica'));
});
Breadcrumbs::for('editarInfoAcademica', function ($trail,$infoAcade) {
    $trail->parent('miPerfilInfoAcademica');
    $trail->push('Actualizar', route('editarInfoAcademica',$infoAcade->id));
});


// @deivid, realizar inscripciones
Breadcrumbs::for('realizarInscripciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Realizar inscripciones', route('realizarInscripciones'));
});

Breadcrumbs::for('listadoInscripciones', function ($trail,$cohorte) {
    $trail->parent('realizarInscripciones');
    $trail->push('Listado de inscritos', route('listadoInscripciones',$cohorte->id));
});
Breadcrumbs::for('nuevaInscripcion', function ($trail,$reg) {
    $trail->parent('listadoInscripciones',$reg->cohorte);
    $trail->push('Nuevo inscripción', route('nuevaInscripcion',$reg->id));
});
Breadcrumbs::for('verInscripcion', function ($trail,$inscri) {
    $trail->parent('listadoInscripciones',$inscri->cohorte);
    $trail->push('Informarmación', route('verInscripcion',$inscri->id));
});

// @deivid, banco de preguntas 
Breadcrumbs::for('bancoPreguntas', function ($trail,$cohorte) {
    $trail->parent('cohortes',$cohorte->maestria);
    $trail->push('Banco de preguntas', route('bancoPreguntas',$cohorte->id));
});

// @deivid, banco de preguntas 
Breadcrumbs::for('admision', function ($trail,$cohorte) {
    $trail->parent('cohortes',$cohorte->maestria);
    $trail->push('Admisión COHORTE '.$cohorte->numero, route('admision',$cohorte->id));
});


// @deivid, mis maestrias
Breadcrumbs::for('misMaestrias', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis maestrías', route('misMaestrias'));
});
Breadcrumbs::for('miCohorteRegistros', function ($trail,$cohorte) {
    $trail->parent('misMaestrias');
    $trail->push('Regsitros de '.$cohorte->maestria->nombre.' COHORTE '.$cohorte->numero, route('miCohorteRegistros',$cohorte->id));
});

Breadcrumbs::for('miCohorteInscritos', function ($trail,$cohorte) {
    $trail->parent('misMaestrias');
    $trail->push('Inscritos de '.$cohorte->maestria->nombre.' COHORTE '.$cohorte->numero, route('miCohorteInscritos',$cohorte->id));
});
Breadcrumbs::for('miCohorteAdmision', function ($trail,$cohorte) {
    $trail->parent('misMaestrias');
    $trail->push('Admisión de '.$cohorte->maestria->nombre.' COHORTE '.$cohorte->numero, route('miCohorteAdmision',$cohorte->id));
});

Breadcrumbs::for('miCohorteAdmisionEntrevistaEnsayo', function ($trail,$admision) {
    $trail->parent('miCohorteAdmision',$admision->cohorte);
    $trail->push('Entrevista y ensayo de '.$admision->user->apellidos_nombres??'--', route('miCohorteAdmisionEntrevistaEnsayo',$admision->id));
});


