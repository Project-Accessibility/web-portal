@extends('errors.minimal')

@section('title', 'Server error')
@section('code', '500')
@if($message)
    @section('message')
        <div class="h2">
            {{$message}}
        </div>
    @endsection
@endif
