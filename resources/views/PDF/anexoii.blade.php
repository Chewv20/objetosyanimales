<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>IDO {{ $fecha }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        h2{
            text-align: center;
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
        .texto2{
            font-family: Arial;
            font-size : 10;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 1.5cm;
            right: 0cm;
            height: 2cm;
        }
        header{
            position: fixed;
            top: 0cm;
            left: 17cm;
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
    @php
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $fcreado = date_create($fecha)
    @endphp
    <header>
        <p class="texto2"><b>Clave: 60000</b></p>
        <p class="texto2" style="margin: -10% 0"><b>SGCC/{{ $oficio }}/<?php echo date_format($fcreado, 'Y');?></b></p>
        <p class="texto2" style="margin: 10% 0"><b>00/00/<?php echo date_format($fcreado, 'Y');?></b></p>
    </header>
    <footer>
        <p class="texto"><b>Anexo II</b></p>
    </footer>
    <h2>Anexo II</h2>
    <?php
        $lineas = ['1','2','3','4','5','6','7','8','9','12','LA','LB'];
        foreach( $lineas as $linea){ ?>
        <!-- Inician las tablas de los eventos cada una de las lineas -->
        <div class="col-12 blk_eventos_L<?php echo $linea; ?>">
            <h5 class="mb-0" ><u>Línea <?php echo $linea; ?></u></h5>
        </div>

        <div class="table-responsive">
            <table BORDER class="tabla" >
                <thead class="text-center">
                    <tr>
                        <th scope="col" class="texto">Hora</th>
                        <th scope="col" class="w-75 texto">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anexoii as $item)
                        @if ($item -> linea == $linea)
                            <tr>
                                <td ALIGN="center"  class="texto tabla">{{ $item->hora }}</td>
                                <td ALIGN="justify" class="texto tabla">{{ $item->descripcion }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    <?php } ?>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(450, 798, "Página                           $PAGE_NUM", $font, 10);
            ');
        }
    </script>
</body>
</html>