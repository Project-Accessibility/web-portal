@extends('errors.minimal')

@section('title', 'Server error')
@section('code', '500')
@section('message')
    <div class="h2">
        {{$message ?? 'Er is een onbekende fout opgetreden.'}}
    </div>
@endsection
