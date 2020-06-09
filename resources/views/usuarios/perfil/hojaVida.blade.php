<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoja de vida</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
       .np-logo {
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 20%;
            height: 75px;
        }
     </style>
</head>
<body>
    <h1 style="text-align: center;" >Formulario de inscripción P-PI03</h1>
    <hr>
    <p style="text-align: right">Fecha: {{ date('d-m-Y') }}</p>
    
    <table style="width:100%">
        <tr>
          <th colspan="3">
            <strong>INFORMACIÓN PERSONAL</strong>
            
          </th>
          
        </tr>
        <tr>
            @if (Storage::exists($user->foto))
                @php($url=base_path().'/storage/app/'.$user->foto)
            @else
                @php($url=public_path('images/demo/users/face6.jpg'))
            @endif
            <td class="np-logo" style=" background-image:url('{{$url}}')">
                
            </td>
            <td colspan="2">
                <strong>Apellidos y Nombres: </strong> {{ $user->apellidos_nombres }} <br>
                <strong>Tipo de identificación: </strong> {{ $user->tipo_identificacion }} <br>
                <strong>Identificación: </strong> {{ $user->identificacion }} <br>
                <strong>Email: </strong> {{ $user->email }} <br>
                <strong>Nacionalidad: </strong> {{ $user->nacionalidad }} <br>
                <strong>Estado civil: </strong> {{ $user->estado_civil }} <br>
                <strong>Sexo: </strong> {{ $user->sexo }} <br>
                <strong>Fecha nacimiento: </strong> {{ $user->fecha_nacimiento }} <br>
                <strong>Etnia: </strong> {{ $user->etnia }} <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 50%;">
                <strong>Teléfono: </strong> {{ $user->telefono }} <br>
                <strong>Celular: </strong> {{ $user->celular }} <br>
                <strong>Dirección: </strong> {{ $user->direccion }} <br>
                <strong>Latitud:</strong> {{ $user->lat }} <br>
                <strong>Longitud:</strong> {{ $user->lng }}
            </td>
            <td>
                <strong>Tiene discapacidad: </strong> {{ $user->tiene_discapacidad }} <br>
                <strong>Porcentaje discapacidad: </strong> {{ $user->porcentaje_discapacidad }} <br>
                <strong>Tiene carnet conadis: </strong> {{ $user->tiene_carnet_conadis }} <br>
                <strong>Carnet conadis: </strong> {{ $user->porcentaje_carnet_conadis }} <br>
            </td>
        </tr>
        @if ($user->informacionLaboral)
        @php($infoLa=$user->informacionLaboral)
            <tr>
                <th colspan="3">INFORMACIÓN LABORAL</th>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;">
                    <strong>Trabaja: </strong> {{ $infoLa->trabaja }} <br>
                    <strong>Tipo de institucion: </strong> {{ $infoLa->tipo_institucion }} <br>
                    <strong>Empresa: </strong> {{ $infoLa->empresa }} <br>
                    <strong>Cargo: </strong> {{ $infoLa->cargo }} <br>
                    <strong>País: </strong> {{ $infoLa->pais }} <br>
                    
                </td>
                <td>
                    <strong>Provincia: </strong> {{ $infoLa->provincia }} <br>
                    <strong>Cantón: </strong> {{ $infoLa->canton }} <br>
                    <strong>Teléfono: </strong> {{ $infoLa->telefono }} <br>
                    <strong>Extención: </strong> {{ $infoLa->extencion }} <br>
                    <strong>Email: </strong> {{ $infoLa->email }} <br>
                </td>
            </tr>
        @else
        <tr>
            <th colspan="3">SIN INFORMACIÓN LABORAL</th>
        </tr>
        @endif

        @if (count($user->informacionAcademicos)>0)
            <tr>
                <th colspan="3">INFORMACIÓN ACADÉMICA</th>
            </tr>
            @foreach ($user->informacionAcademicos as $infoAca)
            <tr>
                <td colspan="2" style="width: 50%;">
                    <strong>Institución: </strong> {{ $infoAca->institucion }} <br>
                    <strong>Nivel: </strong> {{ $infoAca->nivel }} <br>
                    <strong>Tipo de institucion: </strong> {{ $infoAca->tipo_institucion }} <br>
                    <strong>Título: </strong> {{ $infoAca->titulo }} <br>
                    <strong>Especialidad: </strong> {{ $infoAca->especialidad }} <br>
                    <strong>Duración: </strong> {{ $infoAca->duracion }} años<br>
                </td>
                <td>
                    <strong>Fecha de graduación: </strong> {{ $infoAca->fecha_graduacion }} <br>
                    <strong>Calificación de grado: </strong> {{ $infoAca->calificacion_grado }} <br>
                    <strong>Pais: </strong> {{ $infoAca->pais }} <br>
                    <strong>Provincia: </strong> {{ $infoAca->provincia }} <br>
                    <strong>Cantón: </strong> {{ $infoAca->canton }} <br>
                </td>
            </tr>
            
            @endforeach
        @else
        <tr>
            <th colspan="3">SIN INFORMACIÓN ACADÉMICA</th>
        </tr>  
        @endif

        


    </table>
</body>
</html>