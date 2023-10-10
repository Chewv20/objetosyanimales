@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Animales en Vías</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/animales.css') }}" />

@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($objeto as $item)
                        <form action="{{ route('objeto.update', $item->id) }}" method="post" id='form-objeto'>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <x-adminlte-select name='linea' id='selLinea' label='Línea' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-subway"></i>
                                            </div>
                                        </x-slot>
                                        <option value=''>-- Seleccione una línea --</option>
                                        @foreach ($lineas as $linea)
                                            <option value="{{ $linea->id_linea }}" @if ($linea->id_linea==$item->linea) selected                                             
                                            @endif>{{ $linea->linea }}</option>
                                        @endforeach
                                    </x-adminlte-select>  
                                </div>
                                <div class="col-md-4">
                                    <x-adminlte-select name='estacion' id='selEstacion' label='Estación' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-dot-circle"></i>
                                            </div>
                                        </x-slot>
                                        <option value=''>-- Seleccione una estación --</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-2">
                                    <x-adminlte-input name="retardo" id="retardo" label="Retardo" placeholder="Ingresa el retardo" type="number" min=0  value='{{ $item->retardo }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div>
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha"  min="2020-11-04" max="<?php echo $hoy;?>"  value="{{ $item->fecha }}">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-input name='corte_corriente' id="corte_corriente" label='Corte de Corriente' placeholder='Ingresa el corte de corriente' type='text' value='{{ $item->corte_corriente }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-bolt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                
                                <div class="col">
                                    <x-adminlte-input name='tipo_objeto' id='tipo_objeto' label='Tipo de objeto' placeholder='Ingresa el tipo de objeto' type='text' value='{{ $item->tipo_objeto }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>                  
                            
                            
                            <div>
                                <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                            </div>

                            <input type="text" id="estacion" value="{{ $item->estacion }}" hidden >
                            <input type="text" id='usu_correccion' value="{{ auth()->user()->username }}" hidden>
                            
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="{{ URL::asset('js/animales-update.js') }}"></script>

@stop