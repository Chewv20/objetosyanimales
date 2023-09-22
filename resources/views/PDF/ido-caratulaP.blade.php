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
            font-size : 12;
            text-align: justify;
        }
        .texto3{
            font-family: Arial;
            font-size : 10;
            text-align: justify;
        }
        .texto4{
            font-family: Arial;
            font-size : 8;
            text-align: center;
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
        #watermark {
            position: fixed;
            bottom:   -2cm;
            left:    -2cm;


            /** Change image dimensions**/
            width:    28cm;
            height:   28cm;

            /** Your watermark should be behind every content**/
            z-index:  -1000;
        }
        .watermark{
            font-family: Arial;
            font-size : 170;
            color: #D5D5D5;
            transform: rotate(-46deg);
        }
    </style>
</head>
<body>
    <div id="watermark">
        <p class="watermark">Preliminar</p>
    </div>
    @php
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $dias = ['', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $hoy = getdate();
        $fcreado = date_create($fecha)
    @endphp
    <header>
        <img class="img" src="img/header.png" width="100%" height="100%">
    </header>
    <div class="container">
        <div class="row">
            <p class="textoT">Ciudad de México, <?php echo date('d') ; ?> de <?php echo $meses[$hoy['mon']];?> de <?php echo date('Y');?>.</p>
            <p class="textoT" style="margin:-2.5% 0;">60000/SD.G.O./{{ $oficio }}/2023</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <p class="texto2" style="margin:2.5% 0;"><b><I>Ing. Guillermo Calderón Aguilera</I></b></p>
            <p class="texto2" style="margin:-2.5% 0;"><b><I>Director General</I></b></p>
            <p class="texto2" style="margin:2.5% 0;"><b><I>P R E S E N T E</I></b></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <p class="texto2">Por este conducto, me permito enviar a usted el <b>Informe Diario de Operación</b> correspondiente al día <b><?php echo $dias[date_format($fcreado, 'N')];?>
            <?php echo date_format($fcreado, 'd')?> de <?php echo $meses[date_format($fcreado, 'n')];?> de <?php echo date_format($fcreado, 'Y');?> </b>de las 12 Líneas de la Red, mismo que contiene 
            los anexos que se detallan a continuacion: </p>
            <p class="texto2">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Anexo
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                I 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <I>Incidentes en la Circulacion de los Trenes.</I><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Anexo
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                II 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <I>Incidentes Registrados en las Estaciones.</I><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Anexo
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                III
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <I>Número de Vueltas.</I><br>
            </p>
            <br>
            <p class="texto2">
                Sin más por el momento, me reitero a sus órdenes.
                <br><br>
                <b>A T E N T A M E N T E</b>
                <br><br><br>
                <b>MTRO. FRANCISCO ECHAVARRI HERNÁNDEZ</b><br>
                <b>SUBDIRECTOR GENERAL DE OPERACIÓN</b>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <p class="texto3">
                C.c.c.e.p.-Director General (correo electrónico).
            </p>
            <p class="texto3" style="margin:-2.5% 8%;">Subdirección General de Mantenimiento (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Dirección de Transportación (correo electrónico y anexo).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Dirección de Mantenimiento al Material Rodante (correo electrónico y anexo I de Línea 12).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Dirección de Ingeniería y Desarrollo Tecnológico (correo electrónico).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Gerencia de Instalaciones Fijas (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Gerencia de Ingeniería y Nuevos Proyectos (correo electrónico).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Gerencia Jurídica (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Gerencia de Líneas 1, 3, 4 y 12 (correo electrónico).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Gerencia de Líneas 2, 5, 6 y B (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Gerencia de Líneas 7, 8, 9 y A (correo electrónico).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Asesoria de la Dirección General (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">Subgerencia de Control Central (correo electrónico y anexo).</p>
            <p class="texto3" style="margin: -2.5% 8%;">Coordinación de Línea 12 (correo electrónico).</p>
            <p class="texto3" style="margin: 2.5% 8%;">A r c h i v o (correo electrónico).</p>
            <p class="texto3" style="margin: 0 0;">PGSH/JLSO/SPC/NRV</p>

        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <p class="texto4">Delicias N° 67. 4to. Piso. Col. Centro. Alcaldía Cuauhtémoc. C.P. 06070</p>
                <p class="texto4" style="margin: -2.5% 0;">Ciudad de México. Tel. 5589572026</p>
                <p class="texto4" style="margin: 2% 0;">sdgo@metro.cdmx.gob.mx</p>
            </div>
        </div>
    </div>
</body>
</html>