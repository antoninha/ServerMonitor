@extends('template/template')

@section('contenuDeleteMonitor')
    {!! Form::open() !!}
        {!! Form::label('url', 'Choississez une url : ') !!}
        {!! Form::select('id', $monitors->pluck('url', 'id') ) !!}
        {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce monitor ?\')']) !!}  
    {!! Form::close() !!}
@stop