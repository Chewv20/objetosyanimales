@extends('adminlte::page')

@section('title', 'Anexo III')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Número de Vueltas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/anexoii.css') }}" />
@stop

@php
use App\Http\Controllers\AnexoIIIController;
    $hoy = date("Y-m-d");
@endphp

@section('content')

    <p id='fechaHoy'></p>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                        <?php
                        $lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];
                        foreach( $lineas as $linea){ 
                            $evento = AnexoIIIController::get($hoy,$linea);
                            $vueltasP = 0;
                            $vueltasR = 0;
                            foreach ($evento as $item) {
                                $vueltasP+=$item->vueltas;
                                $vueltasR+=$item->vueltas_realizadas;
                            }
                        ?>
                        <x-adminlte-input name="vueltasP" id="vueltasP<?php echo $linea; ?>" type="numer" value="{{ $vueltasP }}" hidden/>
                        <x-adminlte-input name="vueltasR" id="vueltasR<?php echo $linea; ?>" type="numer" value="{{ $vueltasR }}" hidden/>
                        <p>Graficas Linea: {{ $linea }}</p>
                        <canvas id="graficaLinea<?php echo $linea; ?>"></canvas>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    $(document).ready(function(){
        const lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB']
        
        lineas.forEach(element => {
            perdidas = document.getElementById('vueltasP'+element).value
            realizadas = document.getElementById('vueltasR'+element).value
            generaGrafica('graficaLinea'+element,perdidas,realizadas)
        });

        
})

function generaGrafica(id,perdidas,realizadas)
{
    new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Perdidas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [perdidas,realizadas],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
        });
}
</script>

@stop