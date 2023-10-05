@extends('adminlte::page')

@section('title', 'Objetos y Animales')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />


@section('content_header')
    <h1 class="m-0 text-dark">Objetos en Vías</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/objetos.css') }}" />

@stop

@php
    $hoy = date("Y-m-d");
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- Minimal --}}
                    <x-adminlte-modal id="formRegistro" title="Registrar incidente" size="xl" theme="success"
                        icon="fas fa-edit" v-centered scrollable>
                        <form action="/objeto/" id='form-objeto' method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <x-adminlte-select name='selLinea' id='selLinea' label='Línea' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-subway"></i>
                                            </div>
                                        </x-slot>
                                        <option>-- Seleccione una línea --</option>
                                        @foreach ($lineas as $linea)
                                            <option value="{{ $linea->id_linea }}">{{ $linea->linea }}</option>
                                        @endforeach
                                    </x-adminlte-select>  
                                </div>
                                <div class="col-md-4">
                                    <x-adminlte-select name='selEstacion' id='selEstacion' label='Estación' required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text ">
                                                <i class="fa fa-dot-circle"></i>
                                            </div>
                                        </x-slot>
                                        <option>-- Seleccione una estación --</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-2">
                                    <x-adminlte-input name="retardo" label="Retardo" placeholder="Ingresa el retardo" type="number" min=0 required>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div>
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control" name="fecha"  min="2020-11-04" max="<?php echo $hoy;?>">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <x-adminlte-input name='corteCorriente' label='Corte de Corriente' placeholder='Ingresa el corte de corriente' type='text' required>

                                    </x-adminlte-input>
                                </div>
                                
                                <div class="col">
                                    <x-adminlte-input name='tipoObjeto' label='Tipo de objeto' placeholder='Ingresa el tipo de objeto' type='text' required>

                                    </x-adminlte-input>
                                </div>
                            </div>                  
                            
                            
                            <div>
                                <x-adminlte-button id="submit" class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>
                            </div>
                        </form>
                    </x-adminlte-modal>
                    <x-adminlte-button label="Registrar incidente" data-toggle="modal" theme="success" icon="fas fa-plus" data-target="#formRegistro"/>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="{{ URL::asset('js/objetos.js') }}"></script>

@stop