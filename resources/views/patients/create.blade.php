@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Novo paciente</h1>
@stop

@section('content')
    <form action="{{ route('patients.store') }}" method="post">
        <div class="box box-success">
            <div class="box-body">
                {{csrf_field()}}
                @include('patients.form')
                <button class="btn btn-success pull-right">Adicionar</button>
            </div>
        </div>
    </form>
@stop

@include('patients.mask')