@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@if($message)
    @section('message')
        <div class="h2">
            {{$message}}
        </div>
    @endsection
@endif
