<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name','POSGRADOS UTC') }}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        .noBorder {
            border:none !important;
        }

    </style>

</head>
<body>
    <table style="border-collapse: collapse; border: none;">
        <tr>
            <td class="noBorder">
                <img src="{!! public_path('images/UTC.png') !!}" alt="" width="120px;" style="text-align: right;">
            </td>
            <td class="noBorder">
                <h1 style="text-align: center;">
                    DIRECCIÓN DE POSGRADO
                </h1>
            </td>
            <td class="noBorder">

                <img src="{!! public_path('images/posgrados.jpeg') !!}" alt="" width="120px;" style="text-align: right;">
            </td>
        </tr>
    </table>
</body>
</html>