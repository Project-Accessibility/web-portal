@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@if($message)
    <div class="h2">
        @section('message', $message)
    </div>
@endif
