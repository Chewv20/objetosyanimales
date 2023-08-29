<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>IDO {{ $fecha }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        
        h5{
            font-family: Arial;
            font-size : 11;
            text-align: center;
        }
        .texto{
            font-family: Arial;
            font-size : 11;
        }
        .texto.tabla{
            vertical-align: middle;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 1.5cm;
            right: 0cm;
            height: 2cm;
        }
        header{
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 4cm;
        }
        body {
            margin-top: 1.5cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 1.5cm;
        }
        .footer{
            position: fixed;
            bottom: 0cm;
            left: 1.5cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>
<body>
    
    <footer>
        <p class="texto"><b>Informe díario de operación</b></p>
    </footer>
    <?php
        $lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        foreach( $lineas as $linea){ ?>
        <!-- Inician las tablas de los eventos cada una de las lineas -->
        <div class="col-12 blk_eventos_L<?php echo $linea; ?>">
            <h5 class="mb-0" ><u>Línea <?php echo $linea; ?></u></h5>
        </div>

        <div class="table-responsive">
            <table BORDER class="tabla" >
                <thead class="text-center">
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col" class="w-75">Descripción</th>
                        <th scope="col">Retardo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $item)
                        @if ($item -> linea == $linea)
                            <tr>
                                <td ALIGN="center"  class="texto tabla">{{ $item->hora }}</td>
                                <td ALIGN="justify" class="texto tabla">{{ $item->descripcion }}</td>
                                <td ALIGN="center"  class="texto tabla">{{ $item->retardo }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>
</html>