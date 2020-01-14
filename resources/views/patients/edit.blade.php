@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Editar paciente</h1>
@stop

@section('content')
    <form action="{{ route('patients.update', $patient->id) }}" method="post">
        {{ csrf_field() }}
        <div class="box box-success">
            <div class="box-body">
                @include('patients.form')
                <button class="btn btn-success pull-right">Atualizar</button>
            </div>
        </div>
    </form>
@stop

@include('patients.mask')