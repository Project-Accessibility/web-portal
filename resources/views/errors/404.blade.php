@extends('errors.minimal')

@section('title', 'Niet gevonden')
@section('code', '404')
@section('header', 'Pagina niet gevonden')
@section('message')
    <div class="h2">
        {{$message ?? 'URL bestaat niet'}}
    </div>
@endsection
