@extends('template/template')

@section('contenuListMonitor')
    @foreach($monitors as $monitor)
        <ul>
            <li>{{$monitor->url}}  is <b> {{$monitor->uptime_status}} </b> at {{$monitor->uptime_last_check_date}} </li>
        </ul>
    @endforeach
@stop