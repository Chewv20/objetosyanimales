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
    </header>
    <footer>
        <p class="texto"><b>Anexo III</b></p>
    </footer>
    <h2>Anexo III</h2>
    <div class="col-6">
        <p>{{ $dia }}</p>
    </div>
    {{-- <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}" width="500" height="600"> --}}

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