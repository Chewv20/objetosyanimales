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
    $vueltasP = 0;
    $vueltasR = 0;
    $evento = AnexoIIIController::get($hoy);
    foreach ($evento as $item) {
       $vueltasP+=$item->vueltas;
       $vueltasR+=$item->vueltas_realizadas;
    }
@endphp

@section('content')

    <p id='fechaHoy'></p>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                        <p>Las vueltas Perdidas del día son: {{ $vueltasP }}</p>
                        <p>Las vueltas Realizadas del día son: {{ $vueltasR }}</p>
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
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
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
})
</script>

@stop