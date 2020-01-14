@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Novo médico</h1>
@stop

@section('content')
    <form action="{{ route('doctors.store') }}" method="post">
        <div class="box box-success">
            <div class="box-body">
                {{csrf_field()}}
                @include('doctors.form')
                <button class="btn btn-success pull-right">Adicionar</button>
            </div>
        </div>
    </form>
@stop