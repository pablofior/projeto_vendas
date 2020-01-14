@extends('adminlte::page')

@section('title', 'Consultas')

@section('content_header')
    <h1>Nova consulta</h1>
@stop

@section('content')
    <form action="{{ route('appointments.store') }}" method="post">
        <div class="box box-success">
            <div class="box-body">
                {{csrf_field()}}
                @include('appointments.form')
                <button class="btn btn-success pull-right">Adicionar</button>
            </div>
        </div>
    </form>
@stop