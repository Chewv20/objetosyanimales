@extends('adminlte::page')

@section('title', 'Anexo II')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Actualizar Larin Anexo II</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive tbl_anexoi">
                        @foreach ($larin as $item)
                        <form action="{{ route('larinI.update', $item->clave_larin) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="row">
                                <x-adminlte-input name="tipo_larin" label="Tipo de Larin" placeholder="Tipo de Larin" fgroup-class="col-md-7" value="{{ $item->tipo_larin }}" required/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="descripcion_corta" label="Descripcion Corta del Larin" placeholder="Ingresa una descripción corta para el larin" fgroup-class="col-md-7" value="{{ $item->descripcion_corta_larin }}" required/>
                            </div>

                            <div class="row">
                                <x-adminlte-textarea name="larin" label="Larin" placeholder="Ingresa el larin" fgroup-class="col-md-7" rows=10 required>
                                    {{ $item->larin }}
                                </x-adminlte-textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <x-adminlte-button type="submit" label="Enviar" theme="primary" icon="fas fa-save"/>
                                </div>
                            </div>
                        
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="{{ URL::asset('js/larinI.js') }}"></script>

@stop