@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@if($message)
    @section('message')
        <div class="h2">
            {{$message}}
        </div>
    @endsection`
@endif
