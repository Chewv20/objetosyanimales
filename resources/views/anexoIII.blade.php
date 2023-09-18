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
                        <div class="col-8 col-md-5 ">
                            <div class="input-group input-group-sm mb-3">
                               <div class="input-group-prepend d-none d-md-block">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">Ver Gráficas del día</span>
                               </div>
                               <input type="date" id="fecha" class="form-control" name="fecha_inicial" value="<?php echo $hoy;?>" min="2020-11-04" max="<?php echo $hoy;?>">
                            </div>
                        </div>
                        <?php
                        $lineas = ['1','2','3','4','5','6','7','8','9','12','A','B'];
                        foreach( $lineas as $linea){ 
                            $vueltasP = 10;
                            $vueltasR = 10;
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
    let chart
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    $(document).ready(function(){
        const lineas = ['1','2','3','4','5','6','7','8','9','12','A','B']
        lineas.forEach(element => {
            perdidas = document.getElementById('vueltasP'+element).value
            realizadas = document.getElementById('vueltasR'+element).value
            generaGrafica('graficaLinea'+element,perdidas,realizadas)
        });
        document.getElementById('fecha').addEventListener('change',(e)=>{
            console.log(e.target.value);
            creaGrafica()
        })

        
})

function creaGrafica(){
    let vueltas = []
    fetch('/anexoIII/get',{
        method : 'POST',
        body: JSON.stringify({
            fecha : document.getElementById('fecha').value,      
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB']
        lineas.forEach(element => {
            vueltas[element] = 0
        })
        lineas.forEach(element=>{
            data.forEach(item => {
                if(element==item.linea){
                    vueltas[element]-=parseInt(item.vueltas)
                    vueltas[element]+=parseInt(item.vueltas_realizadas)
                }
            })
        })
    }).catch(error => console.error(error));

}

function generaGrafica(id,programadas,realizadas)
{
    chart = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
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