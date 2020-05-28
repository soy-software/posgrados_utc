<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de registro</title>
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
          background-color: #edf2f7;
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
  
    <h1 style="text-align: center;" >Formulario de registro</h1>
    <hr>
    <p style="text-align: right">Fecha: {{ $registro->created_at }}</p>
    <p style="text-align: right">Número de registro: {{ $registro->id }}</p>
    @php($user=$registro->user)
    <table style="width:100%">
      <tr>
        <th colspan="3" style="background-color: #fff;">
          <strong>REGISTRO AL PROGRAMA DE:</strong> {{ $registro->cohorte->maestria->nombre }} <strong>COHORTE </strong> {{ $registro->cohorte->numero }}
        </th>
        
      </tr>
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
      <tr>
        <th colspan="3">
          INFORMACIÓN ACADÉMICA
        </th>
      </tr>
      <tr>
        <td colspan="3">
          <strong>Título de grado. (3er. Nivel): </strong> {{ $registro->institucion??' n/a' }} <br>
          <strong>Especialidad de grado (3er. Nivel): </strong> {{ $registro->titulo??' n/a' }} <br>
          <strong>Institución donde obtuvo el título (3er. Nivel): </strong> {{ $registro->especialidad??' n/a' }}
        </td>
      </tr>
      <tr>
        <th colspan="3">
          COMPLETAR REGISTRO
        </th>
      </tr>
      <tr>
        <td colspan="3">
          <ul>
            <li>Transferir o Pagar valor de registro <strong>$ {{ $registro->valor }}</strong></li>
            <li>Una vez realizado la transferencia debe escanear y subir el comprobante de la transferencia aquí <a href="{{ route('subirComprobanteRegistro',$registro->id) }}"> {{ route('subirComprobanteRegistro',$registro->id) }}</a></li>
            <li>
              Puede realizar el pago de forma personal en la tesorería del departamento Financiero institucional.
            </li>
        </td>
      </tr>
      
      <tr>
          <td style="width: 133px; text-align: center;" colspan="3">
              
              <p>
                  <strong>Puede Transferir o Pagar en la Cuenta de ahorros de, 
                      <br>
                      VILMER DAVID CRIOLLO CHANCHICOCHA
                  <br>
                  C.I: 0503652349
              </strong>
              </p>
              <h2>
                  <strong>BANCO GUAYAQUIL:</strong> 26421068
              </h2>
              
          </td>
      </tr>
    </table>

  

</body>
</html>