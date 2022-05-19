@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@if($message)
    <div class="h2">
        @section('message', $message)
    </div>
@endif
