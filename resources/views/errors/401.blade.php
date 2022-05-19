@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@if($message)
    <div class="h2">
        @section('message', $message)
    </div>
@endif
