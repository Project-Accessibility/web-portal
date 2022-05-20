@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@if($message)
    @section('message')
        <div class="h2">
            {{$message}}
        </div>
    @endsection
@endif
