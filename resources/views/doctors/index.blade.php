@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Médicos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                        <thead>
                            <th>Nome</th>
                            <th>Especialidade</th>
                            <th>CRM</th>
                            <th>Consultas</th>
                            <th>Ações</th>
                        </thead>
                    </table>
                    <a class="btn btn-success pull-right" href="{{route('doctors.create')}}">Adicionar</a>
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
                    url: '{!! route('doctors.datatable') !!}',
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
                    { data: 'name', name: 'name'},
                    { data: 'specialty', name: 'specialty' },
                    { data: 'crm', name: 'crm'},
                    { data: 'appointments', name: 'appointments'},
                    { data: 'actions', name: 'actions'},
                ],
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json" }
            });
        });

        function confirmDelete(id)
        {
            $.confirm({
                title: 'Aviso!',
                content: 'Deseja realmente apagar o médico? Médicos com consultas não serão apagados.',
                buttons: {
                    Não: function () {

                    },
                    Sim: function () {
                        $.get(
                            'doctors/delete/'+id ,
                            {},
                            (response) => {
                                if(response == 'ok') {
                                    dataTable.ajax.reload();
                                    $.alert('Registro apagado.');
                                }else {
                                    $.alert('Não foi possível apagar o registro.', 'Erro!');
                                }
                            }
                        )
                    },
                }
            });
        }
    </script>
@endpush