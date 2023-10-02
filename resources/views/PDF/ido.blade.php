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
            font-family: Arial;
            font-size : 11;
            vertical-align: middle;
        }
        .texto2{
            text-align: center;
            font-family: Arial;
            font-size : 11;
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
            left: 14cm;
            right: 0cm;
            height: 4cm;
        }
        body {
            margin-top: 2cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 1.5cm;
        }
        footer{
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }
        .table{
            display: flex;
            justify-content: center;
        }
        .color-line{ background: #ffd100; }
        .color-porcentaje{
            background: #F7F290;
        }
        .center {
            display: block;
            margin-top: 200px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
</head>
<body>
    
    @php
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $fcreado = date_create($fecha)
    @endphp
    <header>
        <hr width="130" size=3 color="#000000">
        <p class="texto2" style="margin: -2% 0"><b>Clave: 60000</b></p>
        <p class="texto2" style="margin: 1% 0"><b>Ref.: S.D.G.O./{{ $oficio }}/<?php echo date_format($fcreado, 'y');?></b></p>
        <p class="texto2" style="margin: -1% 0"><b><?php echo date_format($fcreado, 'd')?>/<?php echo strtoupper($meses[date_format($fcreado, 'n')]);?>/<?php echo date_format($fcreado, 'Y');?></b></p>
        <hr width="130" size=3 color="#000000">
    </header>
    <footer>
        <hr width="510" size=3 color="#000000">
        <p class="texto" style="margin: 0 1.5cm"><b>Informe díario de operación</b></p>
    </footer>
    <h2>Anexo I</h2>
    <h5>Incidentes en la circulación de trenes</h5>
    <?php
        $realizadas1 = $realizadas['01']+$realizadas['03']+$realizadas['04'];
        $programadas1 = $vueltasPr['01']+$vueltasPr['03']+$vueltasPr['04'];
        $porcentaje1 = $realizadas1*100/$programadas1;
        
        $realizadas2 = $realizadas['02']+$realizadas['05']+$realizadas['06']+$realizadas['LB'];
        $programadas2 = $vueltasPr['02']+$vueltasPr['05']+$vueltasPr['06']+$vueltasPr['LB'];
        $porcentaje2 = $realizadas2*100/$programadas2;
        
        $realizadas3 = $realizadas['07']+$realizadas['08']+$realizadas['09']+$realizadas['LA'];
        $programadas3 = $vueltasPr['07']+$vueltasPr['08']+$vueltasPr['09']+$vueltasPr['LA'];
        $porcentaje3 = $realizadas3*100/$programadas3;
        
        $porcentaje4 = $realizadas['12']*100/$vueltasPr['12'];
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
                                <td ALIGN="center"  class="texto tabla">@if ($item->retardo == 0 )
                                    -
                                @else
                                    {{ $item->retardo }}
                                @endif</td>
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
                    <tr class="color-line">
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
        <div class="table">
            <table BORDER class="tabla" align="center">
                <thead class="text-center">
                    <tr class="color-porcentaje">
                        <th>Línea</th>
                        <th>Programadas</th>
                        <th>Realizadas</th>
                        <th>Cumplimiento del servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Línea 1</td>
                        <td ALIGN="center">{{ $vueltasPr['01'] }}</td>
                        <td ALIGN="center">{{ $realizadas['01'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['01'],2) }}%</td>           
                    </tr>
                    <tr>
                        <td>Línea 3</td>
                        <td ALIGN="center">{{ $vueltasPr['03'] }}</td>
                        <td ALIGN="center">{{ $realizadas['03'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['03'],2) }}%</td>                 
                    </tr>
                    <tr>
                        <td>Línea 4</td>
                        <td ALIGN="center">{{ $vueltasPr['04'] }}</td>
                        <td ALIGN="center">{{ $realizadas['04'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['04'],2)}}%</td>                  
                    </tr>
                    <tr class="color-porcentaje">
                        <td ALIGN="center">Total</td>
                        <td ALIGN="center">{{ $programadas1}}</td>
                        <td ALIGN="center">{{ $realizadas1 }}</td>
                        <td ALIGN="center">@php echo round($porcentaje1,2); @endphp%</td>                  
                    </tr>
                </tbody>
            </table>
        </div>
        <img src="https://quickchart.io/chart/render/sf-a69a3672-286f-4899-822e-4922c9726803?data1={{$vueltasPr['01']}},{{$vueltasPr['03']}},{{$vueltasPr['04']}}&data2={{$realizadas['01']}},{{$realizadas['03']}},{{$realizadas['04']}}" width="500" height="300" class="center">
    </div>
    <div style="page-break-after:always;"></div>

    <div class="col-6">
        <div class="table">
            <table BORDER class="tabla" align="center">
                <thead class="text-center">
                    <tr class="color-porcentaje">
                        <th>Línea</th>
                        <th>Programadas</th>
                        <th>Realizadas</th>
                        <th>Cumplimiento del servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Línea 2</td>
                        <td ALIGN="center">{{ $vueltasPr['02'] }}</td>
                        <td ALIGN="center">{{ $realizadas['02'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['02'],2) }}%</td>           
                    </tr>
                    <tr>
                        <td>Línea 5</td>
                        <td ALIGN="center">{{ $vueltasPr['05'] }}</td>
                        <td ALIGN="center">{{ $realizadas['05'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['05'],2) }}%</td>                 
                    </tr>
                    <tr>
                        <td>Línea 6</td>
                        <td ALIGN="center">{{ $vueltasPr['06'] }}</td>
                        <td ALIGN="center">{{ $realizadas['06'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['06'],2)}}%</td>                  
                    </tr>
                    <tr>
                        <td>Línea B</td>
                        <td ALIGN="center">{{ $vueltasPr['LB'] }}</td>
                        <td ALIGN="center">{{ $realizadas['LB'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['LB'],2)}}%</td>                  
                    </tr>
                    <tr class="color-porcentaje">
                        <td ALIGN="center">Total</td>
                        <td ALIGN="center">{{ $programadas2 }}</td>
                        <td ALIGN="center">{{ $realizadas2 }}</td>
                        <td ALIGN="center">@php echo round($porcentaje2,2); @endphp%</td>                  
                    </tr>
                </tbody>
            </table>
        </div>
        <img src="https://quickchart.io/chart/render/sf-a69a3672-286f-4899-822e-4922c9726803?labels=Línea 2,Línea 5,Línea 6,Línea B&data1={{$vueltasPr['02']}},{{$vueltasPr['05']}},{{$vueltasPr['06']}},{{$vueltasPr['LB']}}&data2={{$realizadas['02']}},{{$realizadas['05']}},{{$realizadas['06']}},{{$realizadas['LB']}}" width="500" height="300" class="center">
    </div>

    <div style="page-break-after:always;"></div>

    <div class="col-6">
        <div class="table">
            <table BORDER class="tabla" align="center">
                <thead class="text-center">
                    <tr class="color-porcentaje">
                        <th>Línea</th>
                        <th>Programadas</th>
                        <th>Realizadas</th>
                        <th>Cumplimiento del servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Línea 7</td>
                        <td ALIGN="center">{{ $vueltasPr['07'] }}</td>
                        <td ALIGN="center">{{ $realizadas['07'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['07'],2) }}%</td>           
                    </tr>
                    <tr>
                        <td>Línea 8</td>
                        <td ALIGN="center">{{ $vueltasPr['08'] }}</td>
                        <td ALIGN="center">{{ $realizadas['08'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['08'],2) }}%</td>                 
                    </tr>
                    <tr>
                        <td>Línea 9</td>
                        <td ALIGN="center">{{ $vueltasPr['09'] }}</td>
                        <td ALIGN="center">{{ $realizadas['09'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['09'],2)}}%</td>                  
                    </tr>
                    <tr>
                        <td>Línea A</td>
                        <td ALIGN="center">{{ $vueltasPr['LA'] }}</td>
                        <td ALIGN="center">{{ $realizadas['LA'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['LA'],2)}}%</td>                  
                    </tr>
                    <tr class="color-porcentaje">
                        <td ALIGN="center">Total</td>
                        <td ALIGN="center">{{ $programadas3 }}</td>
                        <td ALIGN="center">{{ $realizadas3 }}</td>
                        <td ALIGN="center">@php echo round($porcentaje3,2); @endphp%</td>                  
                    </tr>
                </tbody>
            </table>
        </div>
        <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Línea 7','Línea 8','Línea 9','Línea A','Línea 12'], datasets:[{label:'Vueltas Programadas',backgroundColor: 'rgb(251, 255, 0)',data:[{{ $vueltasPr['07'] }},{{ $vueltasPr['08'] }},{{ $vueltasPr['09'] }},{{ $vueltasPr['LA'] }},{{ $vueltasPr['12'] }}]},{label:'Vueltas Realizadas',backgroundColor: 'rgb(138, 138, 138)',data:[{{ $realizadas['07'] }},{{ $realizadas['08'] }},{{ $realizadas['09'] }},{{ $realizadas['LA'] }},{{ $realizadas['12'] }}]}]}}" width="500" height="300" class="center">
    </div>
    <div style="page-break-after:always;"></div>


    <div class="col-6">
        <div class="table">
            <table BORDER class="tabla" align="center">
                <thead class="text-center">
                    <tr class="color-porcentaje">
                        <th>Línea</th>
                        <th>Programadas</th>
                        <th>Realizadas</th>
                        <th>Cumplimiento del servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Línea 12</td>
                        <td ALIGN="center">{{ $vueltasPr['12'] }}</td>
                        <td ALIGN="center">{{ $realizadas['12'] }}</td>
                        <td ALIGN="center">{{ round($porcentaje['12'],2) }}%</td>           
                    </tr>
                    <tr class="color-porcentaje">
                        <td ALIGN="center">Total</td>
                        <td ALIGN="center">{{ $vueltasPr['12'] }}</td>
                        <td ALIGN="center">{{ $realizadas['12'] }}</td>
                        <td ALIGN="center">@php echo round($porcentaje4,2); @endphp%</td>                  
                    </tr>
                </tbody>
            </table>
        </div>
        <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Línea 12'], datasets:[{label:'Vueltas Programadas',backgroundColor: 'rgb(251, 255, 0)',data:[{{ $vueltasPr['12'] }}]},{label:'Vueltas Realizadas',backgroundColor: 'rgb(138, 138, 138)',data:[{{ $realizadas['12'] }}]}]}}" width="500" height="300" class="center">
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