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
            vertical-align: middle;
        }
        .textoT{
            font-family: Arial;
            font-size : 11;
            text-align: right;
        }
        .texto2{
            font-family: Arial;
            font-size : 11;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 1.5cm;
            right: 0cm;
            height: 1cm;
        }
        header{
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 4cm;
        }
        body {
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
        }
    </style>
</head>
<body>
    @php
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $hoy = getdate();
    @endphp
    <header>
        <img class="img" src="img/header.png" width="100%" height="100%">
    </header>
    <div class="container">
        <div class="row">
            <p class="textoT">Ciudad de México, <?php echo date('d') ; ?> de <?php echo $meses[$hoy['mon']];?> de <?php echo date('Y');?>.</p>
            <p class="textoT" style="margin:-2.5% 0;">60000/SD.G.O./ /2023</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <p class="texto2" style="margin:2.5% 0;"><b><I>Ing. Guillermo Calderón Aguilera</I></b></p>
            <p class="texto2" style="margin:-2.5% 0;"><b><I>Director General</I></b></p>
            <p class="texto2" style="margin:2.5% 0;"><b><I>P R E S E N T E</I></b></p>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <footer>
        <p>Informe díario de operación</p>
    </footer>
    <?php
        $lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
        foreach( $lineas as $linea){ ?>
        <!-- Inician las tablas de los eventos cada una de las lineas -->
        <div class="col-12 blk_eventos_L<?php echo $linea; ?>">
            <h5 class="mb-0" ><u>Línea <?php echo $linea; ?></u></h5>
        </div>

        <table class="table table-bordered border-primary">
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
                            <td align="center"  class="texto">{{ $item->hora }}</td>
                            <td align="justify" class="texto">{{ $item->descripcion }}</td>
                            <td align="center"  class="texto">{{ $item->retardo }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    <?php } ?>

    <footer>
        <p>Informe díario de operación</p>
    </footer>
</body>
</html>