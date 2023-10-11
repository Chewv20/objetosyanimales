@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Personas Ajenas en Vías</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/personasajenas.css') }}" />

@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($personasajenas as $item)
                        <form action="{{ route('personasajenas.update', $item->id) }}" method="post" id='form-personasajenas'>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div>
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha" value="{{ $item->fecha }}" min="1992-03-18" max="<?php echo $hoy;?>">
                                    
                                </div>
                                <div class="col-md-3">
                                    <x-adminlte-select name='linea' id='selLinea' label='Línea' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-subway"></i>
                                            </div>
                                        </x-slot>
                                        <option value='0'>-- Seleccione una línea --</option>
                                        @foreach ($lineas as $linea)
                                            <option value="{{ $linea->id_linea }}" @if ($item->linea == $linea->id_linea) selected @endif>{{ $linea->linea }}</option>
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
                                        <option value='0'>-- Seleccione una estación --</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col">
                                    <label for="hora">Hora</label>
                                    <input type="time" name="hora" class="form-control" id="hora" value="{{ $item->hora }}" required>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-textarea name='descripcion' id="descripcion" label='Descripción' rows="5" placeholder='Ingresa la descripción' style="resize: none;" required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fa fa-archive"></i>
                                            </div>
                                        </x-slot>
                                        {{ $item->descripcion }}
                                    </x-adminlte-textarea>
                                </div>
                            </div>    
                            
                            <div class="row">
                                <div class="col-3">
                                    <x-adminlte-input name="retardo" id="retardo" label="Retardo" placeholder="Ingresa el retardo" type="number" min=0 value='{{ $item->retardo }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col">
                                    <x-adminlte-select name='genero' id="genero" label='Genero' >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-male"></i>
                                            </div>
                                        </x-slot>
                                        <option value="" selected>-- Seleccione un genero --</option>
                                        <option value="Masculino" @if ($item->genero == 'Masculino') selected @endif>Masculino</option>
                                        <option value="Femenino" @if ($item->genero == 'Femenino') selected @endif >Femenino</option>
                                    </x-adminlte-select>
                                </div>

                                <div class="col-3">
                                    <x-adminlte-input name="edad" id="edad" label="Edad" placeholder="Ingresa la edad" type="number" min=0 value='{{ $item->edad }}' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>
                            
                            
                            <div class="center">
                                <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                            </div>
                            
                            <input type="text" id="estacion" value="{{ $item->estacion }}" hidden >
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
<script src="{{ URL::asset('js/personasajenas-update.js') }}"></script>

@stop