@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message')
    <div class="h2">
        Het web portaal is op dit moment in onderhoud.<br>
        Kom later terug.
    </div>
@endsection
