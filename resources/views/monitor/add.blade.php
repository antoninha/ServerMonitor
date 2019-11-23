@extends('template/template')

@section('contenuAddMonitor')
    {!! Form::open() !!}
        {!! Form::label('url', 'Entrez votre url : ') !!}
        {!! Form::url('url') !!}
        {!! Form::submit('Enregistrer') !!}
    {!! Form::close() !!}
@stop
