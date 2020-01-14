@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Editar médico</h1>
@stop

@section('content')
    <form action="{{ route('doctors.update', $doctor->id) }}" method="post">
        <div class="box box-success">
            <div class="box-body">
                {{csrf_field()}}
                @include('doctors.form')
                <button class="btn btn-success pull-right">Atualizar</button>
            </div>
        </div>
    </form>
@stop
