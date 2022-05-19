@extends('errors.minimal')

@section('title', 'Server error')
@section('code', '500')
@if($message)
    <div class="h2">
        @section('message', $message)
    </div>
@endif
