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
            left: 15cm;
            right: 0cm;
            height: 4cm;
        }
        body {
            margin-top: 2cm;
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
        .color-line{ background: #ffd100; }
    </style>
</head>
<body>
    @php
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $fcreado = date_create($fecha)
    @endphp
    <header>
        <p class="texto2"><b>Clave: 60000</b></p>
        <p class="texto2" style="margin: -5% 0"><b>Ref.: S.D.G.O./{{ $oficio }}/<?php echo date_format($fcreado, 'y');?></b></p>
        <p class="texto2" style="margin: 5% 0"><b><?php echo date_format($fcreado, 'd')?>/<?php echo strtoupper($meses[date_format($fcreado, 'n')]);?>/<?php echo date_format($fcreado, 'Y');?></b></p>
    </header>
    <footer>
        <p class="texto"><b>Informe díario de operación</b></p>
    </footer>
    <h2>Anexo I</h2>
    <h5>Incidentes en la circulación de trenes</h5>
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
                    <tr class="color-line ">
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

    <div style="page-break-after:always;"></div>

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

    <div style="page-break-after:always;"></div>



    <h2>Anexo III</h2>
    <div class="col-6">
        <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Línea 1','Línea 3','Línea 4'], datasets:[{label:'Vueltas Programadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $vueltasPr['01'] }},{{ $vueltasPr['03'] }},{{ $vueltasPr['04'] }}]},{label:'Vueltas Realizadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $realizadas['01'] }},{{ $realizadas['03'] }},{{ $realizadas['04'] }}]}]},}" width="500" height="300">
        <div class="table">
            <table BORDER class="tabla">
                <thead class="text-center">
                    <tr>
                        <th>Línea</th>
                        <th>Programadas</th>
                        <th>Realizadas</th>
                        <th>Cumplimiento del servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Línea 1</td>
                        <td>{{ $vueltasPr['01'] }}</td>
                        <td>{{ $realizadas['01'] }}</td>
                        <td>{{ $porcentaje['01']}}%</td>           
                    </tr>
                    <tr>
                        <td>Línea 3</td>
                        <td>{{ $vueltasPr['03'] }}</td>
                        <td>{{ $realizadas['03'] }}</td>
                        <td>{{ $porcentaje['03'] }}%</td>                 
                    </tr>
                    <tr>
                        <td>Línea 4</td>
                        <td>{{ $vueltasPr['04'] }}</td>
                        <td>{{ $realizadas['04'] }}</td>
                        <td>{{ $porcentaje['04']}}%</td>                  
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>{{ $vueltasPr['01']+$vueltasPr['03']+$vueltasPr['04'] }}</td>
                        <td>{{ $realizadas['01']+$realizadas['03']+$realizadas['04'] }}</td>
                        <td>{{ ($porcentaje['01']+$porcentaje['03']+$porcentaje['04'])/3 }}%</td>                  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-6">
        <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Línea 2','Línea 5','Línea 6','Línea B'], datasets:[{label:'Vueltas Programadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $vueltasPr['02'] }},{{ $vueltasPr['05'] }},{{ $vueltasPr['06'] }},{{ $vueltasPr['LB'] }}]},{label:'Vueltas Realizadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $realizadas['02'] }},{{ $realizadas['05'] }},{{ $realizadas['06'] }},{{ $realizadas['LB'] }}]}]}}" width="500" height="300">
    </div>
    <div class="col-6">
        <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Línea 7','Línea 8','Línea 9','Línea A','Línea 12'], datasets:[{label:'Vueltas Programadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $vueltasPr['07'] }},{{ $vueltasPr['08'] }},{{ $vueltasPr['09'] }},{{ $vueltasPr['LA'] }},{{ $vueltasPr['12'] }}]},{label:'Vueltas Realizadas',backgroundColor: 'rgb(0, 0, 0)',data:[{{ $realizadas['07'] }},{{ $realizadas['08'] }},{{ $realizadas['09'] }},{{ $realizadas['LA'] }},{{ $realizadas['12'] }}]}]}}" width="500" height="300">
    </div>

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