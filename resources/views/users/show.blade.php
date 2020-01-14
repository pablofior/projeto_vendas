@extends('adminlte::page')

@section('title', 'Consultas')

@section('content_header')
    <h1>Consultas do {{ $title }}<b>{{ $modelName }}</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                        <thead>
                        <th>Médico</th>
                        <th>Paciente</th>
                        <th>Data</th>
                        <th>Ações</th>
                        </thead>
                    </table>
                    <a class="btn btn-success pull-right" href="{{route('appointments.create')}}">Adicionar</a>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        var CSRF_TOKEN;
        var dataTable;

        $(document).ready(function() {
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            dataTable = $('#datatable-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 15,

                ajax: {
                    url: '{!! route('appointments.datatable', ['type' => $type, 'id' => $id]) !!}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN
                    },
                },
                columns: [
                    { data: 'doctor', name: 'doctor'},
                    { data: 'patient', name: 'patient' },
                    { data: 'date', name: 'date'},
                    { data: 'actions', name: 'actions'},
                ],
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json" }
            });
        });

        function confirmDelete(id)
        {
            $.confirm({
                title: 'Aviso!',
                content: 'Deseja realmente desmarcar a consulta?',
                buttons: {
                    Não: function () {

                    },
                    Sim: function () {
                        $.get(
                            'appointments/delete/'+id ,
                            {},
                            (response) => {
                                if(response == 'ok') {
                                    dataTable.ajax.reload();
                                    $.alert('Consulta desmarcada.');
                                }else {
                                    $.alert('Não foi possível desmarcar a consulta.', 'Erro!');
                                }
                            }
                        )
                    },
                }
            });
        }
    </script>
@endpush