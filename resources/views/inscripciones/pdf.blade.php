<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de inscripciones</title>
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
    <h1 style="text-align: center;" >Listado de inscripciones</h1>
    <hr>
    @if (count($inscripciones)>0)
        <table style="width: 100%">
            <tr>
                <td>#</td>
                <td>Identificación</td>
                <td>Apellidos y Nombres</td>
                <td>Email</td>
                <td>Fecha de inscripción</td>
            </tr>
            @php($i=0)
            @foreach ($inscripciones as $ins)
            @php($i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $ins->user->identificacion }}</td>
                    <td>{{ $ins->user->apellidos_nombres }}</td>
                    <td>{{ $ins->user->email }}</td>
                    <td>{{ $ins->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-info" role="alert">
            <strong>No existe inscripciones</strong>
        </div>
    @endif
</body>
</html>