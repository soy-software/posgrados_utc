<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de registro</title>
    <style>
         .noBorder {
            border:none !important;

        }
    </style>
</head>
<body>
    <table style="background-color: #edf2f7;" width="100%" class="noBorder">
        
        <tr class="noBorder">
            <td class="noBorder">
                <table style="background-color: #fff; margin-left: auto; margin-right: auto;" width="90%" class="noBorder">
                    
                    <tr class="noBorder">
                        <td style="width: 100%;" class="noBorder">
                            @include('estaticas.formulario')
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        
    </table>
</body>
</html>