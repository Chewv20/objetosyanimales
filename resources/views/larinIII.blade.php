@extends('adminlte::page')

@section('title', 'Anexo III')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Anexo III</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class=" col-12 table-responsive tbl_anexoii">
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme='dark' scrollable hoverable with-footer beautify bordered footer-theme='dark' >
                            @forelse ($larin as $item)
                                <tr>
                                        <th>{{ $item -> linea }}</th>
                                        <th>{{ $item -> dia }}</th>
                                        <th>{{ $item -> vueltas }}</th>
                                        
                                        <th>
                                            <a href="/larinIII/{{ $item->id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a>
                                        </th>
                                </tr>
                            @empty
                                <tr>Sin larines</tr>
                            @endforelse
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
