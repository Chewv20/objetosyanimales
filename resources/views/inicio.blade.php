@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />



@section('content_header')
    <h1 class="m-0 text-dark">Estadísticas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/estadisticas.css') }}" />
@stop

@section('content')
    @php
        $hoy = date("Y-m-d");
    @endphp

    <div>
        <label for="date">Fecha</label>
        <input id="fecha" type="date" value="<?php echo $hoy;?>" min="2020-11-04" max="<?php echo $hoy;?>">
        <label for="date"> a </label>
        <input id="fecha2" type="date" value="<?php echo $hoy;?>" min="2020-11-04" max="<?php echo $hoy;?>">
        <button type="button" id="filtro" class="btn btn-outline-success" >Aplicar Filtro</button>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'> Objetos en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numObjetos' ></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success"  style="text-align:center; width: 5cm;">
                                <div class="card-header">
                                    <i class='fa fa-trash'>Animales en Vías</i>
                                </div>
                                <div class="card-body textCard" >
                                    <p id='numAnimales' ></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="{{ URL::asset('js/estadisticas.js') }}"></script>

@stop
