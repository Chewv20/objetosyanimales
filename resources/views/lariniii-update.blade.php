@extends('adminlte::page')

@section('title', 'Anexo III')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Actualizar Vueltas programadas Anexo III</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive tbl_anexoi">
                        @foreach ($larin as $item)
                        <form action="{{ route('larinIII.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="row">
                                <x-adminlte-input name="id" label="ID" placeholder="ID" fgroup-class="col-md-7" value="{{ $item->id }}" disabled/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="dia" label="Día de la Semana" placeholder="Ingresa el día de la semana" fgroup-class="col-md-7" value="{{ $item->dia }}" disabled/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="vueltas" label="Vueltas Programadas" placeholder="Ingresa las vueltas programadas" fgroup-class="col-md-7" value="{{ $item->vueltas }}" required/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="dia_numerico" label="Día de la semana" placeholder="Ingresa el día de la semana " fgroup-class="col-md-7" value="{{ $item->dia_numerico }}" disabled/>
                            </div>

                            <div class="row">
                                <x-adminlte-input name="linea" label="Línea" placeholder="Ingresa la línea" fgroup-class="col-md-7" value="{{ $item->linea }}" disabled/>
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