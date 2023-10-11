@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Incidentes Relevantes Dictanimados</h1>
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
                    @foreach ($incidentes as $item)
                        <form action="{{ route('incidentesrelevantes.update', $item->id) }}" method="post" id='form-incidentes'>
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
                                    <x-adminlte-select name='lugar' id='selEstacion' label='Estación' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-dot-circle"></i>
                                            </div>
                                        </x-slot>
                                        <option value=''>-- Seleccione una estación --</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-2">
                                    <x-adminlte-input name="evento" id="evento" label="Evento" placeholder="Ingresa el evento" type="text" value='{{ $item->evento }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div>
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha"  min="1992-03-18" max="<?php echo $hoy;?>"  value="{{ $item->fecha }}">
                                    
                                </div>
                            </div>
                    
                            
                            <div>
                                <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                            </div>

                            <input type="text" id="estacion" value="{{ $item->lugar }}" hidden >
                            <input type="text" name="usu_correccion" id='usu_correccion' value="{{ auth()->user()->username }}" hidden>
                            
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
<script src="{{ URL::asset('js/incidentes-update.js') }}"></script>

@stop