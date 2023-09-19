@extends('adminlte::page')

@section('title', 'Anexo I')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Agregar Larin Anexo I</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive">
                        
                        <form action="{{ route('larinI.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <x-adminlte-input name="clave_larin" label="Clave Larin" placeholder="Ingrese la clave del larin" fgroup-class="col-md-7"  required/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="tipo_larin" label="Tipo de Larin" placeholder="Ingrese el tipo de Larin" fgroup-class="col-md-7" required/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="descripcion_corta" label="Descripcion Corta del Larin" placeholder="Ingresa una descripción corta para el larin" fgroup-class="col-md-7" required/>
                            </div>

                            <div class="row">
                                <x-adminlte-textarea name="larin" label="Larin" placeholder="Ingresa el larin" fgroup-class="col-md-7" rows=10 required>
                                    
                                </x-adminlte-textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <x-adminlte-button type="submit" label="Enviar" theme="primary" icon="fas fa-save"/>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="{{ URL::asset('js/larinI.js') }}"></script>

@stop